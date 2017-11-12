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
        if ($itemObject instanceof Tablet) {
            return self::tablet;
        } else if ($itemObject instanceof Laptop) {
            return self::laptop;
        } else if ($itemObject instanceof Desktop) {
            return self::desktop;
        } else if ($itemObject instanceof Computer) {
            return self::computer;
        } else if ($itemObject instanceof Monitor) {
            return self::monitor;
        } else if ($itemObject instanceof Item) {
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
            case ItemType::monitor:
                return "monitor";
            case ItemType::desktop:
                return "desktop";
            case ItemType::laptop:
                return "laptop";
            case ItemType::tablet:
                return "tablet";
            case ItemType::computer:
                return "computer";
            case ItemType::item:
                return "item";
        }
    }
}