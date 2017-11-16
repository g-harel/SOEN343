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
    return date("Y-m-d H:i:s");
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

    // create a new unit.
    public function create($serial, $itemId, $status) {
        // this can be done since the primary key (serial) is
        // is not auto-generated which means all the necessary
        // information is available.
        $unit = new Unit($serial, $itemId, $status, "NULL", "NULL", "NULL", "NULL");
        $serial = $unit->getSerial();
        $this->identityMap->set(mapSerial($serial), $unit);
        // TODO uow
        return $unit;
    }

    // delete unit from database.
    public function delete($serial) {
        // mark unit in map as deleted.
        $this->identityMap->set(mapSerial($serial), $this::$deletedUnit);
        // TODO uow
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
        $unit = $this->unitGateway->get($serial);
        if ($unit === null) {
            return null;
        }
        // identity map is updated for future fetches.
        $this->identityMap->set(mapSerial($serial), $unit);
        return $unit;
    }

    public function reserve($serial, $accountId) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setAccountId($accountId);
        $unit->setReservedDate(getDate());
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        // TODO uow
        // TODO update items
        // TODO timeout reservations
    }

    public function checkout($serial, $accountId, $purchasedPrice) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setAccountId($accountId);
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice($purchasedPrice);
        $unit->setPurchasedDate(getDate());
        // TODO uow
    }

    public function return($serial) {
        $unit = $this->get($serial);
        if (!$unit) {
            return;
        }
        $unit->setAccountId('NULL');
        $unit->setReservedDate("NULL");
        $unit->setPurchasedPrice("NULL");
        $unit->setPurchasedDate("NULL");
        // TODO uow
        // TODO update items
    }
}