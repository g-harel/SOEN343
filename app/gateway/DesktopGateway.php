<?php

namespace App\Gateway;

class DesktopGateway extends ComputerGateway implements iItemCategory {
    public static $fields = array(
        "height",
        "width",
        "thickness",
    );

    public function buildSelect() {
        return parent::buildSelect()." INNER JOIN desktops ON items.id = desktops.item_id";
    }

    public function buildInsert($item) {
        $fields = $this->fieldsList(self::$fields);
        $values = $this->valueList(self::$fields, $item);
        return parent::buildInsert($item)."INSERT INTO desktops (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
    }

    public function buildUpdate($item) {
        $id = $item["id"];
        $values = $this->updateList(self::$fields, $item);
        return parent::buildUpdate($item)."UPDATE desktops SET $values WHERE item_id = $id;";
    }
}
