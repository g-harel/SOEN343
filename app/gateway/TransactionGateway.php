<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

class TransactionGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "transactions";
        $this->db = new DatabaseGateway();
    }

    public function getTransactionByAccountId($accountId) {
        $conditionsAssociativeArray = ["account_id" => $accountId];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function editTransaction($id, $itemId, $accountId, $purchasePrice, $salesDate) {
        $conditionsAssociativeArray = ["id" => $id];
        $conditions = transformConditionsToString($conditionsAssociativeArray);

        $valuePairs = "item_id = '$itemId', account_id = '$accountId', purchase_price = '$purchasePrice',
        sales_date = '$salesDate'";

        $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";

        return $this->db->queryDB($sql);
    }

    public function addTransaction($itemId, $accountId, $purchasePrice) {
        $sql = "INSERT INTO `$this->tableName`(`item_id`, `account_id`, `purchase_price`) VALUES ('$itemId', '$accountId', '$purchasePrice');";
        $result = $this->db->queryDB($sql);
        return $result;
    }

    public function deleteTransactionById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }
}