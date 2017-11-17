<?php

namespace App\Gateway;

class LaptopGateway extends ComputerGateway implements iItemCategory {
    public static $fields = array(
        "display_size",
        "os",
        "battery",
        "camera",
        "is_touchscreen",
    );

    public function buildSelect() {
        return parent::buildSelect()." INNER JOIN laptops ON items.id = laptops.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList(self::$fields);
        $values = $this->valueList(self::$fields, $item);
        return parent::buildInsert($item)."INSERT INTO laptops (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList(self::$fields, $item);
        return parent::buildUpdate($item)."UPDATE laptops SET $values WHERE item_id = $id;";
    }
}