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

class ComputerController extends Controller
{


    public function index()
    {

    }

    public function showDesktop()
    {
        return view('items.computer.show-desktop', [
            'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)
        ]);
    }

    public function showLaptop()
    {
        return view('items.computer.show-laptop', [
            'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)
        ]);
    }

    public function showTablet()
    {
        return view('items.computer.show-tablet', [
            'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)
        ]);
    }

    public function search() {
        if ($this->isFormSubmitted($_GET)) {
            $desktopFields = [
                'brand' => filter_input(INPUT_GET, 'desktop-brand'),
                'storage' => filter_input(INPUT_GET, 'desktop-storage-capacity'),
                'ramSize' => filter_input(INPUT_GET, 'desktop-ram-size'),
                'maxPrice' => filter_input(INPUT_GET, 'max-price'),
                'minPrice' => filter_input(INPUT_GET, 'min-price'),
                'view' => 'viewDesktop',
                'collection' => 'desktops',
                'itemType' => 3
            ];
            $laptopFields = [
                'brand' => filter_input(INPUT_GET, 'laptop-brand'),
                'storage' => filter_input(INPUT_GET, 'laptop-storage-capacity'),
                'ramSize' => filter_input(INPUT_GET, 'laptop-ram-size'),
                'maxPrice' => filter_input(INPUT_GET, 'max-price'),
                'minPrice' => filter_input(INPUT_GET, 'min-price'),
                'view' => 'viewLaptop',
                'collection' => 'laptops',
                'itemType' => 4
            ];
            $tabletFields = [
                'brand' => filter_input(INPUT_GET, 'tablet-brand'),
                'storage' => filter_input(INPUT_GET, 'tablet-storage-capacity'),
                'ramSize' => filter_input(INPUT_GET, 'tablet-ram-size'),
                'maxPrice' => filter_input(INPUT_GET, 'max-price'),
                'minPrice' => filter_input(INPUT_GET, 'min-price'),
                'view' => 'viewTablet',
                'collection' => 'tablets',
                'itemType' => 5
            ];
            $searchItem = array();
            $computers = array();
            $result = array();
            if (isset($_GET['search-desktop-form'])) {
                $searchItem = $desktopFields;
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType(3);
            } else if (isset($_GET['search-laptop-form'])) {
                $searchItem = $laptopFields;
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType(4);
            } else if (isset($_GET['search-tablet-form'])) {
                $searchItem = $tabletFields;
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType(5);
            }
            foreach ($computers as $computer) {
                if ($searchItem['maxPrice'] == 0) {
                    if ($computer['price'] > $searchItem['minPrice']) {
                        if (($computer['brand'] == $searchItem['brand'] || $searchItem['brand'] == "") &&
                            ($computer['hddSize'] == $searchItem['storage'] || $searchItem['storage'] == "") &&
                            ($computer['ramSize'] == $searchItem['ramSize'] || $searchItem['ramSize'] == "")
                        ) {
                            array_push($result, $computer);
                        }
                    }
                } else if ($searchItem['maxPrice'] > 0) {
                    if ($computer['price'] > $searchItem['minPrice'] && $computer['price'] < $searchItem['maxPrice']) {
                        if (($computer['brand'] == $searchItem['brand'] || $searchItem['brand'] == "") &&
                            ($computer['hddSize'] == $searchItem['storage'] || $searchItem['storage'] == "") &&
                            ($computer['ramSize'] == $searchItem['ramSize'] || $searchItem['ramSize'] == "")
                        ) {
                            array_push($result, $computer);
                        }
                    }
                }
            }
            if (!empty($result)) {
                $numResult = count($result);
                return view('pages.'.$searchItem['view'], [
                    'result' => $result, 'numResult' => $numResult
                ]);
            } else {
                return view('pages.'.$searchItem['view'], [
                    $searchItem['collection'] => ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']),
                    'noResults' => true
                ]);
            }
        }
        return view('pages.view');
    }

    public function insertDesktop()
    {
        if ($this->isFormSubmitted($_POST)) {
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
                return redirect()->back()->with([
                    'itemSuccessfullyAdded' => true,
                    'for' => 'desktop',
                    'link' => 'computer/showDesktop'
                ]);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertLaptop()
    {
        if ($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->laptopValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $laptopItem = [
                    "processorType" => $sanitizedInputs['laptop-processor'],
                    "ramSize" => $sanitizedInputs['laptop-ram-size'],
                    "cpuCores" => $sanitizedInputs['laptop-cpu-cores'],
                    "weight" => $sanitizedInputs['laptop-weight'],
                    "hddSize" => $sanitizedInputs["laptop-storage-capacity"],
                    "category" => "laptop",
                    "displaySize" => $sanitizedInputs["laptop-display-size"],
                    "os" => $sanitizedInputs["laptop-os"],
                    "battery" => $sanitizedInputs["laptop-battery"],
                    "camera" => $sanitizedInputs["laptop-camera"],
                    "isTouchscreen" => $sanitizedInputs["laptop-touchscreen"],
                    "brand" => $sanitizedInputs['laptop-brand'],
                    "price" => $sanitizedInputs['laptop-price'],
                    "quantity" => $sanitizedInputs['laptop-qty'],
                ];
                $addLaptopItem = ItemCatalogMapper::getInstance();
                $addLaptopItem->addNewItem($_SESSION['session_id'], 4, $laptopItem); // ufw
                $addLaptopItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'itemSuccessfullyAdded' => true,
                    'for' => 'laptop',
                    'link' => 'computer/showLaptop'
                ]);
            }
        } else {
            return view('items.create');
        }
    }

    public function insertTablet()
    {
        if ($this->isFormSubmitted($_POST)) {
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
                return redirect()->back()->with([
                    'itemSuccessfullyAdded' => true,
                    'for' => 'tablet',
                    'link' => 'computer/showTablet'
                ]);
            }
        } else {
            return view('items.create');
        }
    }

    public function deleteDesktop()
    {
        if ($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!empty($itemId)) {
                $itemMapper = ItemCatalogMapper::getInstance();
                $itemMapper->removeItem($_SESSION['session_id'], $itemId);
                $itemMapper->commit($_SESSION['session_id']);
                return redirect()->back()->with(['itemSuccessfullyDeleted' => true]);
            } else {
                return view('items.create');
            }
        }
        return view('items.create');
    }

    public function deleteTablet()
    {
        if ($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!empty($itemId)) {
                $itemMapper = ItemCatalogMapper::getInstance();
                $itemMapper->removeItem($_SESSION['session_id'], $itemId);
                $itemMapper->commit($_SESSION['session_id']);
                return redirect()->back()->with(['itemSuccessfullyDeleted' => true]);
            } else {
                return view('items.create');
            }
        }
        return view('items.create');
    }

    public function deleteLaptop()
    {
        if ($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!empty($itemId)) {
                $itemMapper = ItemCatalogMapper::getInstance();
                $itemMapper->removeItem($_SESSION['session_id'], $itemId);
                $itemMapper->commit($_SESSION['session_id']);
                return redirect()->back()->with(['itemSuccessfullyDeleted' => true]);
            } else {
                return view('items.create');
            }
        }
        return view('items.create');
    }

    public function modifyDesktop()
    {
        if ($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->desktopValidationFormInputs());
            $id = filter_input(INPUT_POST, 'desktop-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-desktop', [
                    'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3),
                    'inputErrors' => $emptyArrayKeys, 'alertType' => 'warning'
                ]);
            } else {
                $params = [
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
                $desktopItem = ItemCatalogMapper::getInstance();
                $desktopItem->modifyItem($_SESSION['session_id'], $id, $params);
                $desktopItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3),
                    'itemSuccessfullyModified' => 'desktop'
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
        if ($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->laptopValidationFormInputs());
            $id = filter_input(INPUT_POST, 'laptop-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-laptop', [
                    'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4),
                    'inputErrors' => $emptyArrayKeys, 'alertType' => 'warning'
                ]);
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
                $laptopItem = ItemCatalogMapper::getInstance();
                $laptopItem->modifyItem($_SESSION['session_id'], $id, $params);
                $laptopItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4),
                    'itemSuccessfullyModified' => 'laptop'
                ]);
            }
        } else {
            return view('items.computer.show-laptop', [
                'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)
            ]);
        }
    }

    public function modifyTablet()
    {
        if ($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->tabletValidationFormInputs());
            $id = filter_input(INPUT_POST, 'tablet-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.computer.show-tablet', [
                    'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5),
                    'inputErrors' => $emptyArrayKeys, 'alertType' => 'warning'
                ]);
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
                $tabletItem = ItemCatalogMapper::getInstance();
                $tabletItem->modifyItem($_SESSION['session_id'], $id, $params);
                $tabletItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5),
                    'itemSuccessfullyModified' => 'tablet'
                ]);
            }
        } else {
            return view('items.computer.show-tablet', [
                'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)
            ]);
        }
    }
}

