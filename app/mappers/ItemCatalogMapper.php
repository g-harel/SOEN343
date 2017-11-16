<?php

namespace App\Mappers;

use App\Models\ItemCatalog;
use App\Models\ItemType;
use App\Models\Item;
use App\Models\Tablet;
use App\Models\Desktop;
use App\Models\Laptop;
use App\Models\Monitor;
use App\Models\Computer;
use App\UnitOfWork\UnitOfWork;
use App\IdentityMap\IdentityMap;
use App\Gateway\ComputerGateway;
use App\Gateway\DesktopGateway;
use App\Gateway\LaptopGateway;
use App\Gateway\TabletGateway;
use App\Gateway\MonitorGateway;

class ItemCatalogMapper {

    private const DOMAIN_STORAGE_ARRAY_KEY_PAIRS = [
        ["id", "id"],
        ["category", "category"],
        ["brand", "brand"],
        ["price", "price"],
        ["quantity", "quantity"],
        ["displaySize", "display_size"],
        ["weight", "weight"],
        ["height", "height"],
        ["width", "width"],
        ["thickness", "thickness"],
        ["processorType", "processor_type"],
        ["ramSize", "ram_size"],
        ["cpuCores", "cpu_cores"],
        ["hddSize", "hdd_size"],
        ["os", "os"],
        ["battery", "battery"],
        ["camera", "camera"],
        ["isTouchscreen", "is_touchscreen"]
    ];
    private static $instance;
    private $itemCatalog;
    private $unitOfWork;
    private $identityMap;

    private function __construct() {
        $this->itemCatalog = ItemCatalog::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
        $this->updateCatalog();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new ItemCatalogMapper();
        }
        return self::$instance;
    }

    // Used by the controllers
    public function addNewItem($transactionId, $itemType, $param) {
        $paramArray = $param;
        $paramArray["id"] = "new";
        $item = $this->itemCatalog->createItem($itemType, $paramArray);
        $this->unitOfWork->registerNew($transactionId, self::$instance, $item);
    }

    // Used by the controllers
    public function removeItem($transactionId, $itemId) {
        $item = $this->itemCatalog->getItem($itemId);
        $this->unitOfWork->registerDeleted($transactionId, $item->getId(), self::$instance, $item);
    }

    // Used by the controllers
    public function modifyItem($transactionId, $itemId, $param) {
        $itemInCatalog = $this->itemCatalog->getItem($itemId);
        if ($itemInCatalog !== null) {
            $itemType = ItemType::getItemTypeStringToEnum($param['category']);
            $item = $this->itemCatalog->createItem($itemType, $param);
            $this->unitOfWork->registerDirty($transactionId, $itemId, self::$instance, $item);
            return true;
        } else {
            return false;
        }

    }

    // Used by the controllers
    public function commit($transactionId) {
        $this->unitOfWork->commit($transactionId);
    }

    // Used by the controllers
    public function getItem($itemId){
        $item = $this->itemCatalog->getItem($itemId);
        if ($item === null) {
            return null;
        } else {
            return $this->mapItemToDomainArray($item);
        }
    }

    // Used by the controllers
    public function selectAllItems() {
        $this->updateCatalog();
        $items = $this->itemCatalog->getAllItems();
        return $this->mapItemArrayToDomainArrays($items);
    }

    // Used by the controllers. Here the item type is the enumeration defined in app/models/ItemType (item = 0, monitor = 1, etc)
    public function selectAllItemType($itemType) {
        $this->updateCatalog();
        $items = $this->itemCatalog->getAllItemsType($itemType);
        return $this->mapItemArrayToDomainArrays($items);
    }

    // Used by the unitofwork when commit happens
    public function add(Item $item) {
        $gateway = $this->getGateway($item);
        if ($gateway === null) {
            return false;
        }
        $domainArray = $this->mapItemToDomainArray($item);
        if ($domainArray === null) {
            return false;
        }
        // We remove the key-value pair for "id" since the new item doesn't have a meaningful ID yet (ID are generated by the DB)
        unset($domainArray["id"]);
        $param = $this->mapDomainArrayToStorage($domainArray);

        $id = $gateway->insert($param);
        if ($this->identityMap->hasId($id)){
            return false;
        }
        $item->setId($id);
        $this->identityMap->set($id, $item);
        $this->itemCatalog->addItem($item);
        return true;
    }

    // Used by the unitofwork when commit happens
    public function delete(Item $item) {
        $gateway = $this->getGateway($item);
        if ($gateway === null) {
            return false;
        }
        $id = $item->getId();
        $deleted = $gateway->deleteById($id);
        if ($deleted) {
            $this->identityMap->removeObject($id);
            $this->itemCatalog->removeItem($id);
        }
    }

    // Used by the unitofwork when commit happens
    // NOTE: CURRENTLY, THE ITEM IN THE UNIT OF WORK POINTS TOWARDS THE ITEM IN THE IDENTITY MAP.
    // NEED TO DECOUPLE THOSE TWO FOR THIS METHOD TO BE USEFUL!
    public function edit(Item $item) {
        $gateway = $this->getGateway($item);
        if ($gateway === null) {
            return false;
        }
        $domainArray = $this->mapItemToDomainArray($item);
        $param = $this->mapDomainArrayToStorage($domainArray);
        $gateway->update($param);
        $this->itemCatalog->editItem($item->getId(), $domainArray);
    }

    private function updateCatalog() {

        // GENERATING AN ARRAY OF ALL THE ITEMS IN THE DATABASE
        $itemsArray = array();
        $desktopGateway = new DesktopGateway();
        // CONVERTING FROM STDOBJECT TO ARRAY
        $desktopsObject = $desktopGateway->getAll();
        $desktops = json_decode(json_encode($desktopsObject), True);
        foreach($desktops as $desktop) {
            $itemsArray[] = $this->mapStorageArrayToDomain($desktop);
        }
        $laptopGateway = new LaptopGateway();
        $laptopsObject = $laptopGateway->getAll();
        $laptops = json_decode(json_encode($laptopsObject), True);
        foreach($laptops as $laptop) {
            $itemsArray[] = $this->mapStorageArrayToDomain($laptop);
        }
        $tabletGateway = new TabletGateway();
        $tabletsObject = $tabletGateway->getAll();
        $tablets = json_decode(json_encode($tabletsObject), True);
        foreach($tablets as $tablet) {
            $itemsArray[] = $this->mapStorageArrayToDomain($tablet);
        }
        $monitorGateway = new MonitorGateway();
        $monitorObject = $monitorGateway->getAll();
        $monitors = json_decode(json_encode($monitorObject), True);
        foreach($monitors as $monitor) {
            $itemsArray[] = $this->mapStorageArrayToDomain($monitor);
        }


        // POPULATING THE CATALOG WITH THE RESULTS
        $unvisitedKeysInCatalog = $this->itemCatalog->getCatalogKeys();
        foreach($itemsArray as $itemParamsArray) {
            $itemType = ItemType::getItemTypeStringToEnum($itemParamsArray["category"]);
            $itemId = $itemParamsArray["id"];
            if ($this->itemCatalog->isItemIdInCatalog($itemId)) {
                $this->itemCatalog->editItem($itemId, $itemParamsArray);
                unset($unvisitedKeysInCatalog[$itemId]);
            } else {
                $item = $this->itemCatalog->createItem($itemType, $itemParamsArray);
                $this->itemCatalog->addItem($item);
            }
        }

        // REMOVING THE KEYS THAT HAVN'T BEEN VISITED (MEANING THEY ARE IN THE CATALOG BUT NOT IN DB)
        foreach($unvisitedKeysInCatalog as $key => $value) {
            if ($this->identityMap->hasId($key)) {
                $this->identityMap->removeObject($key);

            }
            $this->itemCatalog->removeItem($key);
        }
    }

    private function getGateway($item) {
      $itemType = ItemType::getItemTypeEnum($item);
        switch($itemType) {
            case ItemType::monitor:
            return new MonitorGateway();
            break;
            case ItemType::computer:
            return new ComputerGateway();
            break;
            case ItemType::desktop:
            return new DesktopGateway();
            break;
            case ItemType::laptop:
            return new LaptopGateway();
            break;
            case ItemType::tablet:
            return new TabletGateway();
            break;
            default:
            return null;
        }
    }

    private function mapItemArrayToDomainArrays($itemArray) {
        $arrayToReturn = array();
        foreach($itemArray as $item) {
            $arrayToReturn[] = $this->mapItemToDomainArray($item);
        }
        return $arrayToReturn;
    }

    private function mapItemToDomainArray($item) {
        if ($item !== null) {
            $itemType = ItemType::getItemTypeEnum($item);
            switch($itemType) {
                case ItemType::item:
                return $this->getItemParams($item);
                case ItemType::monitor:
                return $this->getMonitorParams($item);
                case ItemType::computer:
                return $this->getComputerParams($item);
                case ItemType::desktop:
                return $this->getDesktopParams($item);
                case ItemType::laptop:
                return $this->getLaptopParams($item);
                case ItemType::tablet:
                return $this->getTabletParams($item);
                default:
                return null;
            }
        } else {
            return null;
        }
    }

    private function mapDomainArrayToStorage($domainArray) {
        $storageArray = null;
        foreach (self::DOMAIN_STORAGE_ARRAY_KEY_PAIRS as $pair){
            $domainKeyValue = $pair[0];
            $storageKeyValue = $pair[1];
            if ($this->keyExists($domainKeyValue, $domainArray) && $domainArray[$domainKeyValue] !== null) {
                $storageArray[$storageKeyValue] = $domainArray[$domainKeyValue];
            }
        }
        return $storageArray;
    }

    private function mapStorageArrayToDomain($storageArray) {
        $domainArray = array();
        foreach (self::DOMAIN_STORAGE_ARRAY_KEY_PAIRS as $pair){
            $domainKeyValue = $pair[0];
            $storageKeyValue = $pair[1];
            if ($this->keyExists($storageKeyValue, $storageArray)) {
                $domainArray[$domainKeyValue] = $storageArray[$storageKeyValue];
            }
        }
        return $domainArray;
    }

    private function keyExists($key, $array) {
        if ($key !== null) {
            return array_key_exists($key, $array);
        } else {
            return false;
        }
    }

    private function getItemParams(Item $item) {
        $array = array();
        $array["id"] = $item->getId();
        $array["category"] = $item->getCategory();
        $array["brand"] = $item->getBrand();
        $array["price"] = $item->getPrice();
        $array["quantity"] = $item->getQuantity();
        return $array;
    }

    private function getMonitorParams(Monitor $item) {
        $array = $this->getItemParams($item);
        $array["displaySize"] = $item->getDisplaySize();
        $array["weight"] = $item->getWeight();
        return $array;
    }

    private function getComputerParams(Computer $item) {
        $array = $this->getItemParams($item);
        $array["processorType"] = $item->getProcessorType();
        $array["ramSize"] = $item->getRamSize();
        $array["cpuCores"] = $item->getCpuCores();
        $array["weight"] = $item->getWeight();
        $array["hddSize"] = $item->getHddSize();
        return $array;
    }

    private function getDesktopParams(Desktop $item) {
        $array = $this->getComputerParams($item);
        $array["height"] = $item->getHeight();
        $array["width"] = $item->getWidth();
        $array["thickness"] = $item->getThickness();
        return $array;
    }

    private function getLaptopParams(Laptop $item) {
        $array = $this->getComputerParams($item);
        $array["displaySize"] = $item->getDisplaySize();
        $array["os"] = $item->getOs();
        $array["battery"] = $item->getBattery();
        $array["camera"] = $item->getCamera();
        $array["isTouchscreen"] = $item->getIsTouchscreen();
        return $array;
    }

    private function getTabletParams(Tablet $item) {
        $array = $this->getComputerParams($item);
        $array["height"] = $item->getHeight();
        $array["width"] = $item->getWidth();
        $array["thickness"] = $item->getThickness();
        $array["displaySize"] = $item->getDisplaySize();
        $array["os"] = $item->getOs();
        $array["battery"] = $item->getBattery();
        $array["camera"] = $item->getCamera();
        $array["isTouchscreen"] = $item->getisTouchscreen();
        return $array;
    }

}