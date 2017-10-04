<?php

include_once(__DIR__ . "/DatabaseGateway.php");

/*

-- example insert queries
INSERT INTO items (brand, price, quantity) VALUES ("brand", 12.0, 1);
INSERT INTO computers (item_id, processor_type, ram_size, cpu_cores, weight, type) VALUES (LAST_INSERT_ID(), "ptype", 1, 2, 12.0, "type");
INSERT INTO desktops (item_id, height, width, thickness) VALUES (LAST_INSERT_ID(), 1.0, 2.0, 3.0);

-- example select query
SELECT * FROM desktops
LEFT JOIN computers ON computers.item_id = desktops.item_id
LEFT JOIN items ON items.id = desktops.item_id
WHERE id = 1;

*/

abstract class ItemGateway
{
    private $gateway;

    public $model = "items";
    public $idColumnName = "id";
    public $fields = array(
        "brand",
        "price",
        "quantity",
    );

    public function __construct() {
        $this->gateway = new DatabaseGateway();
    }

    protected static function generation($className, $pastAncestry) {
        return array_merge(array(get_class_vars($className)), $pastAncestry);
    }

    protected function ancestry() {
        return array(get_class_vars("ItemGateway"));
    }

    private function selectRows($condition) {
        // return $this->ancestry();
        $ancestry = $this->ancestry();
        array_shift($ancestry);
        // base query on the current model's table
        $query = "SELECT * FROM $this->model ";
        // for each layer of inheritance, a join must be added
        foreach ($ancestry as $value) {
            $query .= "LEFT JOIN ".$value["model"]." ON ".$value["model"].".".$value["idColumnName"]." = ".$this->model.".".$this->idColumnName." ";
        }
        // add a condition if one is given
        if ($condition) {
            $query .= "WHERE ".transformConditionsToString($condition);
        }
        $query .= ";";
        // query the db and return the result
        return parseSelectResult($this->gateway->queryDB($query));
    }

    public function getAll() {
        return $this->selectRows(null);
    }

    public function getById($id) {
        $row = $this->selectRows(array("id" => $id));
        if ($row != null) {
            return $row[0];
        }
        return null;
    }

    public function insert($item) {
        $ancestry = array_reverse($this->ancestry());
        // the insert on the top level model is done manually because it is
        // different from the rest. (does not have item_id)
        $items = array_shift($ancestry);
        $queries = array();
        array_push($queries, "INSERT INTO ".$items["model"]." (".implode(", ", $items["fields"]).") VALUES (".implode(", ", cherryPick($items["fields"], $item)).");");
        foreach ($ancestry as $value) {
            array_push($queries, "INSERT INTO ".$value["model"]." (item_id, ".implode(", ", $value["fields"]).") VALUES (LAST_INSERT_ID(), '".implode("', '", cherryPick($value["fields"], $item))."');");
        }
        // execute all queries sequentially (they cannot be done in together)
        foreach ($queries as $query) {
            $this->gateway->queryDB($query);
        }
    }
}

// any descendant class from ItemGateway should define its model, the idColumnName
// and its fields as public attributes. these values are used to build the select
// and the insert statements. it should also define a public function named
// ancestry which returns an array of the current class and all its ancestor's
// data. example implementations below. note that this pattern will work for any
// amount of levels of inheritance (ex. Item -> Computer -> Laptop -> Chromebook)
// as long as it is consistent with the database structure.

class TelevisionGateway extends ItemGateway
{
    public $model = "televisions";
    public $idColumnName = "item_id";
    public $fields = array(
        "height",
        "width",
        "thickness",
        "weight",
        "type",
    );

    protected function ancestry() {
        return $this->generation("TelevisionGateway", parent::ancestry());
    }
}

class MonitorGateway extends ItemGateway
{
    public $model = "monitors";
    public $idColumnName = "item_id";
    public $fields = array(
        "display_size",
        "weight",
    );

    protected function ancestry() {
        return $this->generation("MonitorGateway", parent::ancestry());
    }
}

class ComputerGateway extends ItemGateway
{
    public $model = "computers";
    public $idColumnName = "item_id";
    public $fields = array(
        "processor_type",
        "ram_size",
        "cpu_cores",
        "weight",
        "type",
    );

    protected function ancestry() {
        return $this->generation("ComputerGateway", parent::ancestry());
    }
}

class TabletGateway extends ComputerGateway
{
    public $model = "tablets";
    public $idColumnName = "item_id";
    public $fields = array(
        "display_size",
        "width",
        "height",
        "thickness",
        "battery",
        "os",
        "camera",
        "touchscreen",
    );

    protected function ancestry() {
        return $this->generation("TabletGateway", parent::ancestry());
    }
}

class LaptopGateway extends ComputerGateway
{
    public $model = "laptops";
    public $idColumnName = "item_id";
    public $fields = array(
        "display_size",
        "os",
        "battery",
        "camera",
        "touchscreen",
    );

    protected function ancestry() {
        return $this->generation("LaptopGateway", parent::ancestry());
    }
}

class DesktopGateway extends ComputerGateway
{
    public $model = "desktops";
    public $idColumnName = "item_id";
    public $fields = array(
        "height",
        "width",
        "thickness",
    );

    protected function ancestry() {
        return $this->generation("DesktopGateway", parent::ancestry());
    }
}
