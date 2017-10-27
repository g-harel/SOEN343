<?php

namespace App\Gateway;

use App\Gateway\ItemGateway;

class ComputerGateway extends ItemGateway implements iItemCategory {
    public static $fields = array(
        "processor_type",
        "ram_size",
        "cpu_cores",
        "weight",
        "type",
    );

    public function buildSelect() {
        return parent::buildSelect()." LEFT JOIN computers ON items.id = computers.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList(self::$fields);
        $values = $this->valueList(self::$fields, $item);
        return parent::buildInsert($item)."INSERT INTO computers (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList(self::$fields, $item);
        return parent::buildUpdate($item)."UPDATE computers SET $values WHERE item_id = $id;";
    }
}