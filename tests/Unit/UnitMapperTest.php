<?php

// TODO test unit of work
// TODO test max reserved units
// TODO test unit reservation timeout

namespace Tests\Unit;

use Tests\TestCase;

use App\Gateway\UnitGateway;
use App\Mappers\UnitMapper;

class UnitMapperTest extends TestCase {
    public function testGatewayCanRead() {
        $gateway = UnitGateway::getInstance();
        $rows = $gateway->select(array());
        $this->assertTrue(count($rows) > 0);
    }

    public function testGatewayCanWrite() {
        $gateway = UnitGateway::getInstance();
        $serial = "DD56YG87M";
        $itemId = 1;
        $gateway->insert($serial, $itemId);
        $unit = $gateway->select(array("serial" => $serial))[0];
        $this->assertEquals($unit, array(
            "serial" => $serial,
            "item_id" => "$itemId",
            "status" => "AVAILABLE",
            "account_id" => null,
            "reserved_date" => null,
            "purchased_price" => null,
            "purchased_date" => null,
        ));
    }

    public function testGatewayCanDelete() {
        $gateway = UnitGateway::getInstance();
        $serial = "VR32WSOI6";
        $itemId = 1;
        $gateway->insert($serial, $itemId);
        $this->assertTrue(count($gateway->select(array("serial" => $serial))) === 1);
        $gateway->delete($serial);
        $this->assertTrue(count($gateway->select(array("serial" => $serial))) === 0);
    }

    public function testGatewayCanUpdate() {
        $gateway = UnitGateway::getInstance();
        $serial = "X347589K";
        $itemId = 1;
        $reservedDate = "2017-11-16 11:24:00";
        $gateway->insert($serial, $itemId);
        $gateway->update($serial, $itemId, "RESERVED", 1, "$reservedDate", "NULL", "NULL");
        $unit = $gateway->select(array("serial" => $serial))[0];
        $this->assertEquals($unit, array(
            "serial" => $serial,
            "item_id" => "$itemId",
            "status" => "RESERVED",
            "account_id" => 1,
            "reserved_date" => $reservedDate,
            "purchased_price" => null,
            "purchased_date" => null,
        ));
    }

    public function testMapperCanRead() {
        $mapper = UnitMapper::getInstance();
        // serial from default test data.
        $serial = "ABCDEF123";
        $unit = $mapper->get($serial);
        $this->assertTrue($unit["serial"] === $serial);
    }

    public function testMapperCanWrite() {
        $mapper = UnitMapper::getInstance();
        $transactionId = "08135642";
        $serial = "43DR567W";
        $itemId = 1;
        $unit = $mapper->create($transactionId, $serial, $itemId);
        $this->assertTrue(!!$mapper->get($serial));
    }

    public function testMapperCanDelete() {
        $mapper = UnitMapper::getInstance();
        $transactionId = "794432";
        $serial = "12EDFGHUI90";
        $itemId = 1;
        $unit = $mapper->create($transactionId, $serial, $itemId);
        $this->assertTrue(!!$mapper->get($serial));
        $mapper->remove($transactionId, $serial);
        $this->assertFalse(!!$mapper->get($serial));
    }

    public function testMapperCanReserve() {
        $mapper = UnitMapper::getInstance();
        $transactionId = "3679998";
        $serial = "XSQ2345TGVB";
        $itemId = 1;
        $accountId = 1;
        $mapper->create($transactionId, $serial, $itemId);
        $mapper->reserve($transactionId, $serial, $accountId);
        $unit = $mapper->get($serial);
        $this->assertSame($unit["status"], "RESERVED");
        $this->assertSame($unit["reserved_date"], date("Y-m-d H:i:s"));

    }

    public function testMapperCanPurchase() {
        $mapper = UnitMapper::getInstance();
        $transactionId = "01234567";
        $serial = "098UHBFR43";
        $itemId = 1;
        $accountId = 1;
        $purchasedPrice = 12.99;
        $mapper->create($transactionId, $serial, $itemId);
        $mapper->checkout($transactionId, $serial, $accountId, $purchasedPrice);
        $unit = $mapper->get($serial);
        $this->assertSame($unit["status"], "PURCHASED");
        $this->assertSame($unit["purchased_price"], $purchasedPrice);
        $this->assertSame($unit["purchased_date"], date("Y-m-d H:i:s"));
    }

    public function testMapperCanReturn() {
        $mapper = UnitMapper::getInstance();
        $transactionId = "01234567";
        $serial = "NBVCSW300";
        $itemId = 1;
        $mapper->create($transactionId, $serial, $itemId);
        $mapper->return($transactionId, $serial);
        $unit = $mapper->get($serial);
        $this->assertSame($unit["status"], "AVAILABLE");
    }
}
