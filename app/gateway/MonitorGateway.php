<?php

namespace App\Gateway;

use App\Gateway\ItemGateway;

class MonitorGateway extends ItemGateway implements iItemCategory {
  public static $fields = array(
      "display_size",
      "weight",
  );

  public function buildSelect() {
      return parent::buildSelect()." LEFT JOIN monitors ON items.id = monitors.item_id";
  }

  public function buildInsert($item) {
      $fields = $this->fieldsList(self::$fields);
      $values = $this->valueList(self::$fields, $item);
      return parent::buildInsert($item)."INSERT INTO monitors (item_id, $fields) VALUES (LAST_INSERT_ID(), $values);";
  }

  public function buildUpdate($item) {
      $id = $item["id"];
      $values = $this->updateList(self::$fields, $item);
      return parent::buildUpdate($item)."UPDATE monitors SET $values WHERE item_id = $id;";
  }
}