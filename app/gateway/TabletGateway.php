<?php

namespace App\Gateway;

class TabletGateway extends ComputerGateway implements iItemCategory {
    public static $fields = array(
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
        return parent::buildSelect()." INNER JOIN tablets ON items.id = tablets.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList(self::$fields);
        $values = $this->valueList(self::$fields, $item);
        return parent::buildInsert($item)."INSERT INTO tablets (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList(self::$fields, $item);
        return parent::buildUpdate($item)."UPDATE tablets SET $values WHERE item_id = $id AND isDeleted = '0';";
    }
}