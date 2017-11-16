<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

class UnitGateway {
    private static $instance;
    private $db;
    private $tableName;

    private function __construct() {
        $this->tableName = "units";
        $this->db = new DatabaseGateway();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new UnitGateway();
        }
        return self::$instance;
    }

    public function get($serial) {
        $conditionsAssociativeArray = ["serial" => $serial];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function insert($serial, $itemId, $accountId) {
        $sql = "INSERT INTO `units` (`serial`, `item_id`, `account_id`, `status`, `reserved_date`, `purchased_price`, `purchased_date`) VALUES ('$serial', '$itemId', '$accountId', 'AVAILABLE', NULL, NULL, NULL);";
        $result = $this->db->queryDB($sql);
        return $result;
    }

    public function update($sourceSerial, $serial, $itemId, $accountId, $status, $reservedDate, $purchasedPrice, $purchasedDate) {
        $conditionsAssociativeArray = ["serial" => $sourceSerial];
        $conditions = transformConditionsToString($conditionsAssociativeArray);

        // empty values are replaced by null.
        $reservedDate = (!$reservedDate) ? "NULL" : $reservedDate;
        $purchasedPrice = (!$purchasedPrice) ? "NULL" : $purchasedPrice;
        $purchasedDate = (!$purchasedDate) ? "NULL" : $purchasedDate;

        $valuePairs =
            "serial = '$serial"."', ".
            "item_id = '$itemId"."', ".
            "account_id = '$accountId"."', ".
            "status = '$status"."', ".
            "reserved_date = $reservedDate".", ".
            "purchased_price = $purchasedPrice".", ".
            "purchased_date = $purchasedDate";

        $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";

        return $this->db->queryDB($sql);
    }

    public function delete($serial) {
        $conditionsAssociativeArray = ["serial" => $serial];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }
}