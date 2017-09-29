<?php

include_once(__DIR__ . "/DatabaseGateway.php");

/*

INSERT INTO items (brand, price, type) VALUES ("brand", 12.0, "type");
INSERT INTO computers (item_id, processor_type, ram_size, cpu_cores, weight, type) VALUES (5, "ptype", 1, 2, 12.0, "type");
INSERT INTO desktops (item_id, height, width, thickness) VALUES (3, 1.0, 2.0, 3.0);

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
        $tableName = "items";
        $this->db = new DatabaseGateway($tableName);
        $this->currentModel = $currentModel;
        $this->inheritanceChain = $inheritanceChain;
    }

    // TODO reuse condition and result parsing logic from DatabaseGateway
    private function selectRows($condition)
    {
        // base query on the current model's table
        $query = "SELECT * FROM $this->currentModel";
        // for each layer of inheritance, a join must be added
        foreach ($this->inheritanceChain as &$value) {
            $query .= "LEFT JOIN $value ON $value\.item_id = $this->currentModel\.item_id ";
        }
        // join with the root model
        $query .= "LEFT JOIN items ON items.id = $this->currentModel\.item_id ";
        // add a condition if one is given
        if ($condition) {
            $query .= "WHERE $condition";
        }
        $query .= ";";
        // query the db and return the result
        $result = $this->$db->queryDB($query);
        if ($result != null) {
            while ($row = $queryResults->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getAll()
    {
        return $this->selectRows();
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
