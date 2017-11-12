<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

class CartGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "carts";
        $this->db = new DatabaseGateway();
    }

    public function getCartById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function editCart($id, $item1Id, $item2Id, $item3Id, $item4Id, $item5Id,
    $item6Id, $item7Id) {
        $conditionsAssociativeArray = ["id" => $id];
        $conditions = transformConditionsToString($conditionsAssociativeArray);

        $valuePairs = "item1_Id = '$item1Id', item2_Id = '$item2Id', item3_Id = '$item3Id', item4_Id = '$item4Id',
        item5_Id = $item5Id, item6_Id = $item6Id, item7_Id = '$item7Id'";

        $isConditionPresent = $conditionsAssociativeArray != null;

        $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";

        return $this->db->queryDB($sql);
    }

    public function addAccount($item1Id, $item2Id, $item3Id, $item4Id, $item5Id, $item6Id, $item7Id) {
        $sql = "INSERT INTO `accounts`(`item1_Id`, `item2_Id`, `item3_Id`, `item4_Id`, `item5_Id`, `item6_Id`, `item7_Id`) VALUES ('$item1Id', '$item2Id', '$item3Id', '$item4Id', $item5Id, $item6Id, '$item7Id');";
        $result = $this->db->queryDB($sql);
        return $result;
    }

    public function deleteCartById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }
}