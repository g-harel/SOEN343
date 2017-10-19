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

interface iItemCategory {
    public function buildSelect();
    public function buildInsert($id);
    public function buildUpdate();
}

abstract class ItemGateway implements iItemCategory {
    private $gateway;

    public function __construct() {
        $this->gateway = new DatabaseGateway();
    }

    public function getFields() {
        return $this->fields;
    }

    protected function fieldsList() {
        return implode(", ", $this->getFields());
    }

    protected function valueList($item) {
        return implode("`, `", cherryPick($this->getFields(), $item));
    }

    protected function updateList($item) {
        $fields = $this->getFields();
        $values = cherryPick($fields, $item);
        $list = array();
        for ($i = 0; $i < count($values); ++$i) {
            $field = $fields[$i];
            $value = $values[$i];
            array_push("$field = `$value`");
        }
        return implode(", ", $list);
    }

    public function getAll() {
        $sql = $this->buildSelect();
        $result = $this->gateway->queryDB($sql.";");
        return parseSelectResult($result);
    }

    public function getById($id) {
        $sql = $this->buildSelect();
        $result = $this->gateway->queryDB($sql." WHERE id = $id;");
        return parseSelectResult($result);
    }

    public function insert($item) {
        $sql = $this->buildInsert($item);
        $result = $this->gateway->queryDB($sql);
        return parseSelectResult($result);
    }

    public function update($item) {
        $sql = $this->buildUpdate($item);
        $result = $this->gateway->queryDB($sql);
        return parseSelectResult($result);
    }

    // the following values should be overwritten by children

    public $fields = array(
        "category",
        "brand",
        "price",
        "quantity",
    );

    public function buildSelect() {
        return "SELECT * FROM items";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return "INSERT INTO items ($fields) VALUES ($values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return "UPDATE items SET $values WHERE id=$id;";
    }
}

class MonitorGateway extends ItemGateway implements iItemCategory {
    public $fields = array(
        "display_size",
        "weight",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN monitors ON item.id = monitors.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return parent::buildInsert()."INSERT INTO monitors (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return parent::buildUpdate()."UPDATE monitors SET $values WHERE item_id=$id;";
    }
}

class ComputerGateway extends ItemGateway implements iItemCategory {
    public $fields = array(
        "processor_type",
        "ram_size",
        "cpu_cores",
        "weight",
        "type",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN computers ON item.id = computers.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return parent::buildInsert()."INSERT INTO computers (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return parent::buildUpdate()."UPDATE computers SET $values WHERE item_id=$id;";
    }
}

class TabletGateway extends ComputerGateway implements iItemCategory {
    public $fields = array(
        "display_size",
        "width",
        "height",
        "thickness",
        "battery",
        "os",
        "camera",
        "is_touchscreen",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN tablets ON item.id = tablets.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return parent::buildInsert()."INSERT INTO tablets (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return parent::buildUpdate()."UPDATE tablets SET $values WHERE item_id=$id;";
    }
}

class LaptopGateway extends ComputerGateway implements iItemCategory {
    public $fields = array(
        "display_size",
        "os",
        "battery",
        "camera",
        "is_touchscreen",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN laptops ON item.id = laptops.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return parent::buildInsert()."INSERT INTO laptops (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return parent::buildUpdate()."UPDATE laptops SET $values WHERE item_id=$id;";
    }
}

class DesktopGateway extends ComputerGateway implements iItemCategory {
    public $fields = array(
        "height",
        "width",
        "thickness",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN desktops ON item.id = desktops.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList();
        $values = $this->valueList($item);
        return parent::buildInsert()."INSERT INTO desktops (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList($item);
        return parent::buildUpdate()."UPDATE desktops SET $values WHERE item_id=$id;";
    }
}
