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

    public function select($conditionsAssociativeArray) {
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function insert($serial, $itemId) {
        $sql = "INSERT INTO `units` (`serial`, `item_id`, `status`, `account_id`, `reserved_date`, `purchased_price`, `purchased_date`) VALUES ('$serial', '$itemId', 'AVAILABLE', NULL, NULL, NULL, NULL);";
        $result = $this->db->queryDB($sql);
        return $result;
    }

    public function delete($serial) {
        $conditionsAssociativeArray = ["serial" => $serial];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function update($serial, $itemId, $status, $accountId, $reservedDate, $purchasedPrice, $purchasedDate) {
        $conditionsAssociativeArray = ["serial" => $serial];
        $conditions = transformConditionsToString($conditionsAssociativeArray);
        if ($reservedDate !== "NULL") {
            $reservedDate = "'$reservedDate'";
        }
        if ($purchasedDate !== "NULL") {
            $purchasedDate = "'$purchasedDate'";
        }
        $valuePairs =
            "item_id = '$itemId"."', ".
            "status = '$status"."', ".
            // these fields are purposefully left without apostrophes
            // so that the value can be set to more exotic values.
            "account_id = $accountId".", ".
            "reserved_date = $reservedDate".", ".
            "purchased_price = $purchasedPrice".", ".
            "purchased_date = $purchasedDate";
        $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";

        return $this->db->queryDB($sql);
    }
}
