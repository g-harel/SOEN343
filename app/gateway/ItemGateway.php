<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

/*

-- example select query
SELECT * FROM desktops
LEFT JOIN computers ON computers.item_id = desktops.item_id
LEFT JOIN items ON items.id = desktops.item_id
WHERE id = 1;

-- example insert queries
INSERT INTO items (brand, price, quantity) VALUES ("brand", 12.0, 1);
INSERT INTO computers (item_id, processor_type, ram_size, cpu_cores, weight, type) VALUES (LAST_INSERT_ID(), "ptype", 1, 2, 12.0, "type");
INSERT INTO desktops (item_id, height, width, thickness) VALUES (LAST_INSERT_ID(), 1.0, 2.0, 3.0);

-- example update queries
UPDATE items SET brand = samsung, price = 42.00;
UPDATE computers SET weight = 32;

*/

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

    public function getAll() {
        $sql = $this->buildSelect();
        $result = $this->gateway->queryDB($sql.";");
        return parseSelectResult($result);
    }

    public function getByCondition($condition) {
        $sql = $this->buildSelect();
        $conditionString = transformConditionsToString($condition);
        $result = $this->gateway->queryDB($sql." WHERE $conditionString;");
        return parseSelectResult($result);
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
        "quantity",
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
