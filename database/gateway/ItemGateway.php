<?php

include_once(__DIR__ . "/DatabaseGateway.php");

/*

INSERT INTO items (brand, price, quantity) VALUES ("brand", 12.0, 1);
INSERT INTO computers (item_id, processor_type, ram_size, cpu_cores, weight, type) VALUES (1, "ptype", 1, 2, 12.0, "type");
INSERT INTO desktops (item_id, height, width, thickness) VALUES (1, 1.0, 2.0, 3.0);

SELECT * FROM desktops
LEFT JOIN computers ON computers.item_id = desktops.item_id
LEFT JOIN items ON items.id = desktops.item_id;

*/

class ItemGateway
{
    private $gateway;

    public $model = "items";
    public $idColumnName = "id";
    public $fields = array("");

    public function __construct() {
        $this->gateway = new DatabaseGateway("");
    }

    protected static function generation($className, $pastAncestry) {
        return array_merge(array(get_class_vars($className)), $pastAncestry);
    }

    protected function ancestry() {
        return array(get_class_vars("ItemGateway"));
    }

    // TODO reuse condition and result parsing logic from DatabaseGateway
    private function selectRows($condition)
    {
        // return $this->ancestry();
        $ancestry = $this->ancestry();
        array_shift($ancestry);
        // base query on the current model's table
        $query = "SELECT * FROM $this->model ";
        // for each layer of inheritance, a join must be added
        foreach ($ancestry as &$value) {
            $query .= "LEFT JOIN ".$value["model"]." ON ".$value["model"].".".$value["idColumnName"]." = ".$this->model.".".$this->idColumnName." ";
        }
        // add a condition if one is given
        if ($condition) {
            $query .= "WHERE $condition";
        }
        $query .= ";";
        // query the db and return the result
        $queryResult = $this->gateway->queryDB($query);
        $result = null;
        if ($queryResult != null) {
            while ($row = $queryResult->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getAll()
    {
        return $this->selectRows(null);
    }

    public function getById($id)
    {
        $row = $this->selectRows("id = $id");
        if ($row != null) {
            return $row[0];
        }
        return null;
    }
}

class ComputerGateway extends ItemGateway {
    public $model = "computers";
    public $idColumnName = "item_id";
    public $fields = array("");

    protected function ancestry() {
        return $this->generation("ComputerGateway", parent::ancestry());
    }
}

class DesktopGateway extends ComputerGateway {
    public $model = "desktops";
    public $idColumnName = "item_id";
    public $fields = array("");

    protected function ancestry() {
        return $this->generation("DesktopGateway", parent::ancestry());
    }
}
