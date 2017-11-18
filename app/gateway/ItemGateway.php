<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

Interface iItemCategory {
    public function buildSelect();
    public function buildInsert($id);
    public function buildUpdate($id);
}

abstract class ItemGateway implements iItemCategory {
    private $gateway;

    public function __construct() {
        $this->gateway = new DatabaseGateway();
    }

    protected function fieldsList($fields) {
        return implode(", ", $fields);
    }

    protected function valueList($fields, $item) {
        return "'".implode("', '", cherryPick($fields, $item))."'";
    }

    protected function updateList($fields, $item) {
        $values = cherryPick($fields, $item);
        $list = array();
        for ($i = 0; $i < count($values); ++$i) {
            $field = $fields[$i];
            $value = $values[$i];
            array_push($list, "$field = '$value'");
        }
        return implode(", ", $list);
    }


    public function getSerialNumberByID($itemID,$tableName){
        $arr = ['item_id' => $itemID];
        return singleTableSelectAccountQuery($arr,$tableName);
    }
    public function getByCondition($condition) {
        $sql = $this->buildSelect();
        $sql .= " ".
            "LEFT JOIN ( ".
                "SELECT serial,item_id, COUNT(*) AS 'quantity' FROM units ".
                "WHERE status='AVAILABLE' ".
                "GROUP BY item_id ".
            ") counts ".
            "ON counts.item_id = items.id";
        $conditionString = transformConditionsToString($condition);
        if (trim($conditionString)) {
            $sql .= " WHERE $conditionString;";
        } else {
            $sql .= ";";
        }
        $result = $this->gateway->queryDB($sql);
        $parsedResult = parseSelectResult($result);
        if (!$parsedResult) {
            return array();
        }
        foreach ($parsedResult as $index => $item) {
            if (is_null($item["quantity"])) {
                $parsedResult[$index]["quantity"] = 0;
            }
        }
        return $parsedResult;
    }

    public function getAll() {
        return $this->getByCondition(array());
    }

    public function getById($id) {
        return $this->getByCondition(array("id" => $id));
    }

    public function insert($item) {
        $sql = $this->buildInsert($item);
        $result = $this->gateway->queryDB($sql);
        return $result;
    }

    public function update($item) {
        $sql = $this->buildUpdate($item);
        $result = $this->gateway->queryDB($sql);
        return parseSelectResult($result);
    }

    public function deleteByCondition($condition) {
        $conditionString = transformConditionsToString($condition);
        $result = $this->gateway->queryDB("DELETE FROM items WHERE $conditionString;");
        return parseSelectResult($result);
    }

    public function deleteById($id) {
        return $this->deleteByCondition(array("id" => $id));
    }

    public function delete($item) {
        return $this->deleteByCondition(array("id" => $item["id"]));
    }

    // the following values should be overwritten by children

    public static $fields = array(
        "category",
        "brand",
        "price",
    );

    public function buildSelect() {
        return "SELECT * FROM items";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList(self::$fields);
        $values = $this->valueList(self::$fields, $item);
        return "INSERT INTO items ($fields) VALUES ($values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList(self::$fields, $item);
        return "UPDATE items SET $values WHERE id = $id;";
    }
}
