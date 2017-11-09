<?php

namespace App\Models;

use App\Models\ItemType;

class ItemCatalog {

    private static $catalog;
    private static $instance;

    private function __construct() {
        self::$catalog = array();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new ItemCatalog();
        }
        return self::$instance;
    }

    public function addItem($item) {
        if ($this->isItemInCatalog($item)) {
            return false;
        } else {
            self::$catalog[$item->getId()] = $item;
            return true;
        }
    }

    public function createItem($itemType, $params) {
            switch($itemType) {
                case ItemType::item:
                return new Item($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"]);
                case ItemType::monitor:
                return new Monitor($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"], $params["displaySize"], $params["weight"]);
                case ItemType::computer:
                return new Computer($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"], $params["processorType"], $params["ramSize"], $params["cpuCores"], $params["weight"], $params["hddSize"]);
                case ItemType::desktop:
                return new Desktop($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"], $params["processorType"], $params["ramSize"], $params["cpuCores"], $params["weight"], $params["hddSize"], $params["height"], $params["width"], $params["thickness"]);
                case ItemType::laptop:
                return new Laptop($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"], $params["processorType"], $params["ramSize"], $params["cpuCores"], $params["weight"], $params["hddSize"], $params["displaySize"], $params["os"], $params["battery"], $params["camera"], $params["isTouchscreen"]);
                case ItemType::tablet:
                return new Tablet($params["id"], $params["category"], $params["brand"], $params["price"], $params["quantity"], $params["processorType"], $params["ramSize"], $params["cpuCores"], $params["weight"], $params["hddSize"], $params["displaySize"], $params["width"], $params["height"], $params["thickness"], $params["battery"], $params["os"], $params["camera"]);
                default:
                return false;
            }
            return true;
    }

    public function removeItem($itemId) {
        if ($this->isItemIdInCatalog($itemId)) {
            unset(self::$catalog[$itemId]);
            return true;
        } else {
            return false;
        }
    }

    public function getItem($itemId) {
        if ($this->isItemIdInCatalog($itemId)) {
            return self::$catalog[$itemId];
        } else {
            return null;
        }
    }

    public function getAllItems() {
        return self::$catalog;
    }

    public function getAllItemsType($type) {
        $arrayToReturn = array();
        foreach(self::$catalog as $item) {
            if(ItemType::getItemTypeEnum($item) === $type) {
                $arrayToReturn[] = $item;
            }
        }
        return $arrayToReturn;
    }

    public function editItem($itemId, $itemParam) {
        $item = $this->getItem($itemId);
        if ($item !== null) {
            $itemType = ItemType::getItemTypeEnum($item);
            switch($itemType) {
                case ItemType::item:
                $this->setItemParams($item, $itemParam);
                break;
                case ItemType::monitor:
                $this->setMonitorParams($item, $itemParam);
                break;
                case ItemType::computer:
                $this->setComputerParams($item, $itemParam);
                break;
                case ItemType::desktop:
                $this->setDesktopParams($item, $itemParam);
                break;
                case ItemType::laptop:
                $this->setLaptopParams($item, $itemParam);
                break;
                case ItemType::tablet:
                $this->setTabletParams($item, $itemParam);
                break;
                default:
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function clearCatalog() {
        self::$catalog = array();
    }

    private function isItemInCatalog($item) {
        return $this->isItemIdInCatalog($item->getId());
    }

    public function isItemIdInCatalog($itemId) {
        if ($itemId !== null) {
            return array_key_exists($itemId, self::$catalog);
        } else {
            return false;
        }
    }

    public function getCatalogKeys() {
        $keys = array_keys(self::$catalog);
        return array_fill_keys($keys, array());
    }

    private function setItemParams(Item $item, $param) {
        $item->setId($param["id"]);
        $item->setCategory($param["category"]);
        $item->setBrand($param["brand"]);
        $item->setPrice($param["price"]);
        $item->setQuantity($param["quantity"]);
    }

    private function setMonitorParams(Monitor $item, $param) {
        $this->setItemParams($item, $param);        
        $item->setDisplaySize($param["displaySize"]);
        $item->setWeight($param["weight"]);
    }

    private function setComputerParams(Computer $item, $param) {
        $this->setItemParams($item, $param);
        $item->setProcessorType($param["processorType"]);
        $item->setRamSize($param["ramSize"]);
        $item->setCpuCores($param["cpuCores"]);
        $item->setWeight($param["weight"]);
        $item->setHddSize($param["hddSize"]);
    }

    private function setDesktopParams(Desktop $item, $param) {
        $this->setComputerParams($item, $param);
        $item->setHeight($param["height"]);
        $item->setWidth($param["width"]);
        $item->setThickness($param["thickness"]);
    }

    private function setLaptopParams(Laptop $item, $param) {
        $this->setComputerParams($item, $param);
        $item->setDisplaySize($param["displaySize"]);
        $item->setOs($param["os"]);
        $item->setBattery($param["battery"]);
        $item->setCamera($param["camera"]);
        $item->setIsTouchscreen($param["isTouchscreen"]);
    }

    private function setTabletParams(Tablet $item, $param) {
        $this->setComputerParams($item, $param);
        $item->setHeight($param["height"]);
        $item->setWidth($param["width"]);
        $item->setThickness($param["thickness"]);
        $item->setDisplaySize($param["displaySize"]);
        $item->setOs($param["os"]);
        $item->setBattery($param["battery"]);
        $item->setCamera($param["camera"]);
    }

}