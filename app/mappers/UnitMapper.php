<?php

namespace App\Mappers;

use App\Models\Unit;
use App\Gateway\unitGateway;
use App\UnitOfWork\UnitOfWork;
use App\IdentityMap\IdentityMap;

// prefixes the serial number to make it unique to the
// unit mapper.
function mapSerial($serial) {
    return "unit-$serial";
}

function getDate() {
    return date("'Y-m-d H:i:s'");
}

class UnitMapper {
    private static $instance;
    private static $deletedUnit;

    private $unitGateway;
    private $identityMap;
    private $unitOfWork;

    private function __construct() {
        $this->unitGateway = UnitGateway::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
        $this::$deletedUnit = new Unit(null, null, null, null, null, null, null);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new UnitMapper();
        }
        return self::$instance;
    }

    public function commit($transactionId) {
        $this->unitOfWork->commit($transactionId);
    }

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

    // create a new unit.
    public function create($transactionId, $serial, $itemId) {
        // this can be done since the primary key (serial) is
        // is not auto-generated which means all the necessary
        // information is available.
        $unit = new Unit($serial, $itemId, "AVAILABLE", "NULL", "NULL", "NULL", "NULL");
        $serial = $unit->getSerial();
        $this->identityMap->set(mapSerial($serial), $unit);
        $this->unitOfWork->registerNew($transactionId, self::$instance, $unit);
        return $unit;
    }

    // delete unit from database.
    public function remove($transactionId, $serial) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        // mark unit in map as deleted.
        $this->identityMap->set(mapSerial($serial), $this::$deletedUnit);
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
            if ($unit === $this::$deletedUnit) {
                return null;
            }
            return $unit;
        }
        $res = $this->unitGateway->select(["serial" => $serial]);
        if ($res === null) {
            return null;
        }
        $unit = $res[0];
        $unit = new Unit(
            $unit["serial"],
            $unit["item_id"],
            $unit["status"],
            $unit["account_id"],
            $unit["reserved_date"],
            $unit["purchased_price"],
            $unit["purchased_date"]
        );
        // identity map is updated for future fetches.
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
        $unit->setStatus("RESERVED");
        $unit->setAccountId($accountId);
        $unit->setReservedDate(getDate());
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
        // TODO update items
        // TODO timeout reservations
    }

    // checked out units are associated with an account and
    // specify their purchase price and time.
    public function checkout($transactionId, $serial, $accountId, $purchasedPrice) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setStatus("PURCHASED");
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
        $unit->setStatus("AVAILABLE");
        $unit->setAccountId('NULL');
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
        // TODO update items
    }

    public function getCart($accountId) {
        // loading all units into identity map.
        $res = $this->unitGateway->select(array());
        if ($res) {
            for ($i = 0; $i <= count($res); $i++) {
                $res[$i] = $this->get($res[$i]["serial"]);
            }
        }
        return array_filter($res, function ($v) {
            return $v->getAccountId() === $accountId;
        }, ARRAY_FILTER_USE_BOTH);
        // TODO test
    }

    public function getPurchases() {
        // TODO
    }
}