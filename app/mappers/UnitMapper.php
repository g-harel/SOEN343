<?php

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
    return date("Y-m-d H:i:s");
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

    public static function getInstance(): UnitCatalog {
        if (self::$instance === null) {
            self::$instance = new UnitCatalog();
        }
        return self::$instance;
    }

    // helper to convert an array of column values into
    // a unit object.
    public function toObject(array $record): Unit {
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

    // helper to convert an object of type unit into an
    // associative array.
    public function toArray(Unit $object): array {
        return array(
            "serial" => $object->getSerial(),
            "item_id" => $object->getItemId(),
            "status" => $object->getStatus(),
            "account_id" => $object->getAccountId(),
            "reserved_date" => $object->getReservedDate(),
            "purchased_price" => $object->getPurchasedPrice(),
            "purchased_date" => $object->getPurchasedDate()
        );
    }

    public function add(Unit $unit): bool {
        if (isset($this->catalog[$unit->getSerial()])) {
            return false;
        }
        $this->catalog[$unit->getSerial()] = $unit;
        return true;
    }

    public function remove(Unit $unit): void {
        unset($this->catalog[$unit->getSerial()]);
    }

    public function query($accountId, $status): array {
        $arr = array();
        foreach($this->catalog as $unit) {
            $isStatus = $unit->getStatus() === $status;
            $isAccount = $unit->getAccountId() === $accountId;
            if ($isStatus && $isAccount) {
                array_push($arr, $this->toArray($unit));
            }
        }
        return $arr;
    }

    public function fetchAvailableUnitsByItemId($itemId, $status): array {
        $arr = [];
        foreach ($this->catalog as $unit) {
            $isStatus = $unit->getStatus() === $status;
            $isItemId = $unit->getItemId() === $itemId;
            if($isStatus && $isItemId) {
                array_push($arr, $this->toArray($unit));
            }
        }
        return $arr;
    }

    public function reserve(Unit $unit, $accountId): void {
        $unit->setStatus(StatusEnum::RESERVED);
        $unit->setAccountId($accountId);
        $unit->setReservedDate(getDate());
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
    }

    public function checkout(Unit $unit, $accountId, $purchasedPrice): void {
        $unit->setStatus(StatusEnum::PURCHASED);
        $unit->setAccountId($accountId);
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice($purchasedPrice);
        $unit->setPurchasedDate(getDate());
    }

    public function return(Unit $unit): void {
        $unit->setStatus(StatusEnum::AVAILABLE);
        $unit->setAccountId('NULL');
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
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
        if (!$res) {
            return;
        }
        for ($i = 0; $i < count($res); $i++) {
            $unit = $this->catalog->toObject($res[$i]);
            $this->identityMap->set(mapSerial($unit->getSerial()), $unit);
            $this->catalog->add($unit);
            // all accounts' reserved items are made available
            // if the reservation expires.
            if ($unit->getStatus() === StatusEnum::RESERVED) {
                $maxReservationMinutes = 5;
                $secondsSinceReserved = time() - strtotime($unit->getReservedDate());
                if ($secondsSinceReserved > $maxReservationMinutes*60) {
                    $this->catalog->return($unit);
                    $this->edit($unit);
                }
            }
        }
    }

    public static function getInstance(): UnitMapper {
        if (self::$instance === null) {
            self::$instance = new UnitMapper();
        }
        return self::$instance;
    }

    // fetches unit object from identity map or from the gateway.
    // returns null if the unit is not found.
    private function getObject($serial): ?Unit {
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

    ////////////////////////////////
    ///  UNIT OF WORK INTERFACE  ///
    ////////////////////////////////

    public function add($object): void {
        $this->unitGateway->insert(
            $object->getSerial(),
            $object->getItemId()
        );
        $this->edit($object);
    }

    public function edit($object): void {
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

    public function delete($object): void {
        $this->unitGateway->delete($object->getSerial());
    }

    ////////////////////////////
    ///  CONTROLLER METHODS  ///
    ////////////////////////////

    public function commit($transactionId): void {
        $this->unitOfWork->commit($transactionId);
    }

    // fetches an item from memory, and returns it as an
    // associative array.
    public function get($serial): ?array {
        $unit = $this->getObject($serial);
        if (!$unit) {
            return null;
        }
        return $this->catalog->toArray($unit);
    }

    // create a new unit. note that the status is not set in
    // this method. the units' actions are defined below.
    public function create($transactionId, $serial, $itemId): bool {
        // this can be done since the primary key (serial) is
        // is not auto-generated which means all the necessary
        // information is available.
        $unit = new Unit($serial, $itemId, StatusEnum::AVAILABLE, "NULL", "NULL", "NULL", "NULL");
        $serial = $unit->getSerial();
        // the catalog returns whether the unit's id wasn't
        // already in the catalog, making the creation invalid.
        $success = $this->catalog->add($unit);
        if (!$success) {
            return false;
        }
        $this->identityMap->set(mapSerial($serial), $unit);
        $this->unitOfWork->registerNew($transactionId, self::$instance, $unit);
        return true;
    }

    // delete unit from database.
    public function remove($transactionId, $serial): void {
        $unit = $this->getObject($serial);
        if (!$unit) {
            return;
        }
        $this->catalog->remove($unit);
        $this->identityMap->set(mapSerial($serial), $this->deletedUnit);
        $this->unitOfWork->registerDeleted($transactionId, mapSerial($serial), self::$instance, $unit);
    }

    // reserved units are associated with an account and
    // store their reserved time.
    public function reserve($transactionId, $serial, $accountId): bool {
        $unit = $this->getObject($serial);
        if (!$unit) {
            return false;
        }
        $cartSize = count($this->getCart($accountId));
        if ($cartSize > 6) {
            return false;
        }
        $this->catalog->reserve($unit, $accountId);
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
        return true;
    }

    // checked out units are associated with an account and
    // specify their purchase price and time.
    public function checkout($transactionId, $serial, $accountId, $purchasedPrice): bool {
        $unit = $this->getObject($serial);
        if (!$unit) {
            return false;
        }
        $this->catalog->checkout($unit, $accountId, $purchasedPrice);
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
        return true;
    }

    // returned units are not associated to any account and
    // have no reserved/purchased fields. note that this method
    // is used to return from both the reserved and the purchased
    // states.
    public function return($transactionId, $serial): bool {
        $unit = $this->getObject($serial);
        if (!$unit) {
            return false;
        }
        $this->catalog->return($unit);
        $this->unitOfWork->registerDirty($transactionId, mapSerial($serial), self::$instance, $unit);
        return true;
    }

    public function getCart($accountId): array {
        return $this->catalog->query($accountId, StatusEnum::RESERVED);
    }

    public function getPurchased($accountId): array {
        return $this->catalog->query($accountId, StatusEnum::PURCHASED);
    }

    public function getAvailableUnitsByItemId($itemId) {
        return $this->catalog->fetchAvailableUnitsByItemId($itemId, StatusEnum::AVAILABLE);
    }
}