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
    private $db;

    private $currentModel;
    private $inheritanceChain;
    private $rootModel = "items";

    public function __construct($currentModel, $inheritanceChain = array())
    {
        $this->db = new DatabaseGateway("");
        $this->currentModel = $currentModel;
        $this->inheritanceChain = $inheritanceChain;
    }

    // TODO reuse condition and result parsing logic from DatabaseGateway
    private function selectRows($condition)
    {
        // base query on the current model's table
        $query = "SELECT * FROM $this->currentModel ";
        // for each layer of inheritance, a join must be added
        foreach ($this->inheritanceChain as &$value) {
            $query .= "LEFT JOIN $value ON $value.item_id = $this->currentModel.item_id ";
        }
        // join with the root model
        $query .= "LEFT JOIN items ON items.id = $this->currentModel.item_id ";
        // add a condition if one is given
        if ($condition) {
            $query .= "WHERE $condition";
        }
        $query .= ";";
        // query the db and return the result
        $queryResult = $this->db->queryDB($query);
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
