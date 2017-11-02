<?php

namespace App\Models;

abstract class ItemType {

    const item = 0;
    const monitor = 1;
    const computer = 2;
    const desktop = 3;
    const laptop = 4;
    const tablet = 5;

    public static function getItemTypeEnum($itemObject) {
        if ($item instanceof Tablet) {
            return self::tablet;
        } else if ($item instanceof Laptop) {
            return self::laptop;
        } else if ($item instanceof Desktop) {
            return self::desktop;
        } else if ($item instanceof Computer) {
            return self::computer;
        } else if ($item instanceof Monitor) {
            return self::monitor;
        } else if ($item instanceof Item) {
            return self::item;
        }
    }

    public static function getItemTypeStringToEnum($itemTypeString) {
        if ($itemTypeString === "item") {
            return self::item;            
        } else if ($itemTypeString === "monitor"){
            return self::monitor;            
        } else if ($itemTypeString === "computer"){
            return self::computer;            
        } else if ($itemTypeString === "desktop"){
            return self::desktop;            
        } else if ($itemTypeString === "laptop"){
            return self::laptop;            
        } else if ($itemTypeString === "tablet"){
            return self::tablet;            
        } 
    }

    public static function getItemTypeEnumToString($itemType) {
        switch($itemType) {
            case ItemType::item:
            return "item";
            case ItemType::monitor:
            return "monitor";
            case ItemType::computer:
            return "computer";
            case ItemType::desktop:
            return "desktop";
            case ItemType::laptop:
            return "laptop";
            case ItemType::tablet:
            return "tablet";
        }
    }
}