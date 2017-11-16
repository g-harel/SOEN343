<?php

// TODO create new units at the same time as items
// TODO timeout unit reservations
// TODO limit unit reservations
// TODO update item count when unit is reserved
// TODO update item count when unit is returned

namespace App\Mappers;

use App\Models\Unit;
use App\Gateway\UnitGateway;
use App\UnitOfWork\UnitOfWork;
use App\UnitOfWork\CollectionMapper;
use App\IdentityMap\IdentityMap;

// enum for the three possible unit statuses.
class StatusEnum {
    const AVAILABLE = "AVAILABLE";
    const RESERVED = 'RESERVED';
    const PURCHASED = 'PURCHASED';
}

// prefixes the serial string to ensure it is unique when
// given to the identitiy map.
function mapSerial($serial) {
    return "unit-$serial";
}

// creates an sql timestamp of the current time.
function getDate() {
    return date("'Y-m-d H:i:s'");
}

// maintains a list of the available units and references
// to the in-memory objects. Although the identity map is
// used as the source of truth, this class is useful to
// represent the aggregate of units.
class UnitCatalog {
    private static $instance;

    private $catalog;

    private function __construct() {
        $this->catalog = array();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new UnitCatalog();
        }
        return self::$instance;
    }

    public function toObject($record) {
        return new Unit(
            $record["serial"],
            $record["item_id"],
            $record["status"],
            $record["account_id"],
            $record["reserved_date"],
            $record["purchased_price"],
            $record["purchased_date"]
        );
    }

    public function add(Unit $unit) {
        $this->catalog[$unit->getSerial()] = $unit;
    }

    public function remove(Unit $unit) {
        unset($this->catalog[$unit->getSerial()]);
    }

    public function query($accountId, $status) {
        $arr = array();
        foreach($this->catalog as $item) {
            $isStatus = $item->getStatus() === $status;
            $isAccount = $item->getAccountId() === $accountId;
            if ($isStatus && $isAccount) {
                array_push($arr, $item);
            }
        }
        return $arr;
    }
}

class UnitMapper implements CollectionMapper {
    private static $instance;

    private $deletedUnit;
    private $unitGateway;
    private $identityMap;
    private $unitOfWork;
    private $catalog;

    private function __construct() {
        $this->deletedUnit = new Unit(null, null, null, null, null, null, null);
        $this->unitGateway = UnitGateway::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
        $this->catalog = UnitCatalog::getInstance();

        // loading all units into the identity map/catalog.
        // since this is the executed in the constructor, it
        // is assumed that the identity map has no values for
        // this mapper and that nothing will be overwritten.
        $res = $this->unitGateway->select(array());
        if ($res) {
            for ($i = 0; $i < count($res); $i++) {
                $unit = $this->catalog->toObject($res[$i]);
                $this->identityMap->set(mapSerial($unit->getSerial()), $unit);
                $this->catalog->add($unit);
            }
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new UnitMapper();
        }
        return self::$instance;
    }

    ////////////////////////////////
    ///  UNIT OF WORK INTERFACE  ///
    ////////////////////////////////

    public function add($object) {
        $this->unitGateway->insert(
            $object->getSerial(),
            $object->getItemId()
        );
        $this->edit($object);
    }

    public function edit($object) {
        $this->unitGateway->update(
            $object->getSerial(),
            $object->getItemId(),
            $object->getStatus(),
            $object->getAccountId(),
            $object->getReservedDate(),
            $object->getPurchasedPrice(),
            $object->getPurchasedDate()
        );
    }

    public function delete($object) {
        $this->unitGateway->delete($object->getSerial());
    }

    ////////////////////////////
    ///  CONTROLLER METHODS  ///
    ////////////////////////////

    public function commit($transactionId) {
        $this->unitOfWork->commit($transactionId);
    }

    // create a new unit. note that the status is not set in
    // this method. the units' actions are defined below.
    public function create($transactionId, $serial, $itemId) {
        // this can be done since the primary key (serial) is
        // is not auto-generated which means all the necessary
        // information is available.
        $unit = new Unit($serial, $itemId, StatusEnum::AVAILABLE, "NULL", "NULL", "NULL", "NULL");
        $serial = $unit->getSerial();
        $this->identityMap->set(mapSerial($serial), $unit);
        $this->catalog->add($unit);
        $this->unitOfWork->registerNew($transactionId, self::$instance, $unit);
        return $unit;
    }

    // delete unit from database.
    public function remove($transactionId, $serial) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $this->identityMap->set(mapSerial($serial), $this->deletedUnit);
        $this->catalog->remove($unit);
        $this->unitOfWork->registerDeleted($transactionId, mapSerial($serial), self::$instance, $unit);
    }

    // fetches unit object from identity map or from the gateway.
    // returns null if the unit is not found.
    public function get($serial) {
        $exists = $this->identityMap->hasId(mapSerial($serial));
        if ($exists) {
            $unit = $this->identityMap->getObject(mapSerial($serial));
            // deleted units are set to this value so that reads
            // do not go fetch the value from the database (where
            // it still exists until work is committed)
            if ($unit === $this->deletedUnit) {
                return null;
            }
            return $unit;
        }
        $res = $this->unitGateway->select(["serial" => $serial]);
        if ($res === null) {
            return null;
        }
        $unit = $this->catalog->toObject($res[0]);
        $this->identityMap->set(mapSerial($serial), $unit);
        return $unit;
    }

    // reserved units are associated with an account and
    // store their reserved time.
    public function reserve($transactionId, $serial, $accountId) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setStatus(StatusEnum::RESERVED);
        $unit->setAccountId($accountId);
        $unit->setReservedDate(getDate());
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
    }

    // checked out units are associated with an account and
    // specify their purchase price and time.
    public function checkout($transactionId, $serial, $accountId, $purchasedPrice) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setStatus(StatusEnum::PURCHASED);
        $unit->setAccountId($accountId);
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice($purchasedPrice);
        $unit->setPurchasedDate(getDate());
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
    }

    // returned units are not associated to any account and
    // have no reserved/purchased fields.
    public function return($transactionId, $serial) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setStatus(StatusEnum::AVAILABLE);
        $unit->setAccountId('NULL');
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
    }

    public function getCart($accountId) {
        return $this->catalog->query($accountId, StatusEnum::RESERVED);
    }

    public function getPurchased($accountId) {
        return $this->catalog->query($accountId, StatusEnum::PURCHASED);
    }
}