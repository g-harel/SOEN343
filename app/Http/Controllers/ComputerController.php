<?php

namespace App\Http\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Mappers\ItemCatalogMapper;
use App\Gateway;
use App\Gateway\DesktopGateway;
use App\Gateway\TabletGateway;
use App\Gateway\LaptopGateway;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\Tablet;

//const item = 0;
//const monitor = 1;
//const computer = 2;
//const desktop = 3;
//const laptop = 4;
//const tablet = 5;

class ComputerController extends Controller
{
    public function index() {

    }

    public function showDesktop() {
        return view('items.computer.show-desktop', ['desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)]);
    }

    public function showLaptop() {
        return view('items.computer.show-laptop', ['laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)]);
    }

    public function showTablet() {
        return view('items.computer.show-tablet', ['tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)]);
    }

    public function insertDesktop()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->desktopValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {

                $params = [
                    "processorType" => $sanitizedInputs['desktop-processor'],
                    "ramSize" => $sanitizedInputs['desktop-ram-size'],
                    "cpuCores" => $sanitizedInputs['desktop-cpu-cores'],
                    "weight" => $sanitizedInputs['desktop-weight'],
                    "hddSize" => $sanitizedInputs["desktop-storage-capacity"],
                    "category" => "desktop",
                    "brand" => $sanitizedInputs['desktop-brand'],
                    "price" => $sanitizedInputs['desktop-price'],
                    "quantity" => $sanitizedInputs['desktop-qty'],
                    "width" => $sanitizedInputs['desktop-width'],
                    "height" => $sanitizedInputs['desktop-height'],
                    "thickness" => $sanitizedInputs['desktop-thickness'],
                ];



                $addDesktopItem = ItemCatalogMapper::getInstance();
                $addDesktopItem->addNewItem($_SESSION['session_id'], 3, $params); // ufw
                $addDesktopItem->commit($_SESSION['session_id']);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'desktop']);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertLaptop()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->laptopValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $laptopItem = [
                    "processor_type" => $sanitizedInputs['laptop-processor'],
                    "ram_size" => $sanitizedInputs['laptop-ram-size'],
                    "cpu_cores" => $sanitizedInputs['laptop-cpu-cores'],
                    "weight" => $sanitizedInputs['laptop-weight'],
                    "hdd_size" => $sanitizedInputs["laptop-storage-capacity"],
                    "category" => "laptop",
                    "brand" => $sanitizedInputs['laptop-brand'],
                    "price" => $sanitizedInputs['laptop-price'],
                    "quantity" => $sanitizedInputs['laptop-qty'],
                    "display_size" => $sanitizedInputs['laptop-display-size'],
                    "os" => $sanitizedInputs['laptop-os'],
                    "battery" => $sanitizedInputs['laptop-battery'],
                    "camera" => $sanitizedInputs['laptop-camera'],
                    "is_touchscreen" => $sanitizedInputs['laptop-touchscreen'],
                ];
                $laptopGateway = new LaptopGateway();
                $laptopGateway->insert($laptopItem);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'laptop']);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertTablet()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->tabletValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {

                $params = [
                    "processorType" => $sanitizedInputs['tablet-processor'],
                    "ramSize" => $sanitizedInputs['tablet-ram-size'],
                    "cpuCores" => $sanitizedInputs['tablet-cpu-cores'],
                    "weight" => $sanitizedInputs['tablet-weight'],
                    "hddSize" => $sanitizedInputs["tablet-storage-capacity"],
                    "category" => "tablet",
                    "brand" => $sanitizedInputs['tablet-brand'],
                    "price" => $sanitizedInputs['tablet-price'],
                    "quantity" => $sanitizedInputs['tablet-qty'],
                    "displaySize" => $sanitizedInputs['tablet-display-size'],
                    "width" => $sanitizedInputs['tablet-width'],
                    "height" => $sanitizedInputs['tablet-height'],
                    "thickness" => $sanitizedInputs['tablet-thickness'],
                    "battery" => $sanitizedInputs['tablet-battery'],
                    "os" => $sanitizedInputs['tablet-os'],
                    "camera" => $sanitizedInputs['tablet-camera'],
                    "isTouchscreen" => $sanitizedInputs['tablet-touchscreen']
                ];

                $addTabletItem = ItemCatalogMapper::getInstance();
                $addTabletItem->addNewItem($_SESSION['session_id'], 5, $params); // ufw
                $addTabletItem->commit($_SESSION['session_id']);
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'tablet']);
            }
        } else {
            return view('items.create');
        }
    }

    public function deleteDesktop(){
        if($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($itemId)) {
                $itemMapper = ItemCatalogMapper::getInstance();
                $itemMapper->removeItem($_SESSION['session_id'], $itemId);
                $itemMapper->commit($_SESSION['session_id']);
            } else {
                return view('items.create');
            }
        }
        return view('items.create');
    }

    public function deleteTablet() {
        if($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($itemId)) {
                $itemMapper = ItemCatalogMapper::getInstance();
                $itemMapper->removeItem($_SESSION['session_id'], $itemId);
                $itemMapper->commit($_SESSION['session_id']);
            } else {
                return view('items.create');
            }
        }
        return view('items.create');
    }

    public function modifyDesktop()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->desktopValidationFormInputs());
            $id = filter_input(INPUT_POST, 'desktop-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-desktop', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $desktopParams = [
                    "id" => $id,
                    "processorType" => $sanitizedInputs["desktop-processor"],
                    "ramSize" => $sanitizedInputs["desktop-ram-size"],
                    "cpuCores" => $sanitizedInputs["desktop-cpu-cores"],
                    "weight" => $sanitizedInputs["desktop-weight"],
                    "hddSize" => $sanitizedInputs["desktop-storage-capacity"],
                    "category" => "desktop",
                    "brand" => $sanitizedInputs["desktop-brand"],
                    "price" => $sanitizedInputs["desktop-price"],
                    "quantity" => $sanitizedInputs["desktop-qty"],
                    "height" => $sanitizedInputs["desktop-height"],
                    "width" => $sanitizedInputs["desktop-width"],
                    "thickness" => $sanitizedInputs["desktop-thickness"]
                ];

                $addTabletItem = ItemCatalogMapper::getInstance();
                $addTabletItem->modifyItem($_SESSION['session_id'], 3, $desktopParams);
                $addTabletItem->commit($_SESSION['session_id']);
                return view('items.computer.show-desktop', [
                    'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3),
                    'succeedModifyingItem' => 'desktop'
                ]);
            }
        } else {
            return view('items.computer.show-desktop', [
                'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)
            ]);
        }
    }

    public function modifyLaptop()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->laptopValidationFormInputs());
            $id = filter_input(INPUT_POST, 'laptop-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-laptop', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $params = [
                    "id" => $id,
                    "processorType" => $sanitizedInputs['laptop-processor'],
                    "ramSize" => $sanitizedInputs['laptop-ram-size'],
                    "cpuCores" => $sanitizedInputs['laptop-cpu-cores'],
                    "weight" => $sanitizedInputs['laptop-weight'],
                    "hddSize" => $sanitizedInputs["laptop-storage-capacity"],
                    "category" => "laptop",
                    "brand" => $sanitizedInputs['laptop-brand'],
                    "price" => $sanitizedInputs['laptop-price'],
                    "quantity" => $sanitizedInputs['laptop-qty'],
                    "displaySize" => $sanitizedInputs['laptop-display-size'],
                    "os" => $sanitizedInputs['laptop-os'],
                    "battery" => $sanitizedInputs['laptop-battery'],
                    "camera" => $sanitizedInputs['laptop-camera'],
                    "isTouchscreen" => $sanitizedInputs['laptop-touchscreen'],
                ];
                $addTabletItem = ItemCatalogMapper::getInstance();
                $addTabletItem->modifyItem($_SESSION['session_id'], 3, $params);
                $addTabletItem->commit($_SESSION['session_id']);
                return view('items.computer.show-laptop', [
                    'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(3),
                    'succeedModifyingItem' => 'laptop'
                ]);
            }
        } else {
            return view('items.computer.show-laptop', ['laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)]);
        }
    }

    public function modifyTablet()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->tabletValidationFormInputs());
            $id = filter_input(INPUT_POST, 'tablet-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-tablet', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $params = [
                    "id" => $id,
                    "processorType" => $sanitizedInputs['tablet-processor'],
                    "ramSize" => $sanitizedInputs['tablet-ram-size'],
                    "cpuCores" => $sanitizedInputs['tablet-cpu-cores'],
                    "weight" => $sanitizedInputs['tablet-weight'],
                    "hddSize" => $sanitizedInputs["tablet-storage-capacity"],
                    "category" => "tablet",
                    "brand" => $sanitizedInputs['tablet-brand'],
                    "price" => $sanitizedInputs['tablet-price'],
                    "quantity" => $sanitizedInputs['tablet-qty'],
                    "displaySize" => $sanitizedInputs['tablet-display-size'],
                    "width" => $sanitizedInputs['tablet-width'],
                    "height" => $sanitizedInputs['tablet-height'],
                    "thickness" => $sanitizedInputs['tablet-thickness'],
                    "battery" => $sanitizedInputs['tablet-battery'],
                    "os" => $sanitizedInputs['tablet-os'],
                    "camera" => $sanitizedInputs['tablet-camera'],
                    "isTouchscreen" => $sanitizedInputs['tablet-touchscreen']
                ];
                $addTabletItem = ItemCatalogMapper::getInstance();
                $addTabletItem->modifyItem($_SESSION['session_id'], 5, $params);
                $addTabletItem->commit($_SESSION['session_id']);
                return redirect()->back()->with(['succeedModifyingItem' => true]);
            }
        } else {
            return view('items.computer.show-tablet');
        }

    }
}

