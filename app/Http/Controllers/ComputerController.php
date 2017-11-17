<?php

namespace App\Http\Controllers;

use App\Mappers\ItemCatalogMapper;
use App\Mappers\UnitMapper;
use App\Models\Unit;

class ComputerController extends Controller
{
    public function index()
    {

    }

    public function showDesktop()
    {
        return view('items.computer.show-desktop', [
            'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE)
        ]);
    }

    public function showLaptop()
    {
        return view('items.computer.show-laptop', [
            'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE)
        ]);
    }

    public function showTablet()
    {
        return view('items.computer.show-tablet', [
            'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE)
        ]);
    }

    public function addLaptopUnits(){

        $numOfUnits = $_POST['numOfUnits'];
        $itemID = $_POST['laptop-id'];
        $units = array();
        for($i = 0; $i< $numOfUnits; $i++){
            $units[$i] = new Unit($_POST['serial'.$i],$itemID,"Available","","","","");
        }
        $unitMapper =  UnitMapper :: getInstance();
        foreach($units as $unit){
            $unitMapper->create($_SESSION['session_id'],$unit->getSerial(),$unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);

        }
    }
    public function search() {
        if ($this->isFormSubmitted($_GET)) {
            $searchItem = array();
            $computers = array();
            $result = array();
            if (isset($_GET['admin-search-desktop-form']) ||
                isset($_GET['client-search-desktop-form'])) {
                $searchItem = $this->desktopFilteringFields();
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']);
            } else if (isset($_GET['admin-search-laptop-form']) ||
                isset($_GET['client-search-laptop-form'])) {
                $searchItem = $this->laptopFilteringFields();
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']);
            } else if (isset($_GET['admin-search-tablet-form']) ||
                isset($_GET['client-search-tablet-form'])) {
                $searchItem = $this->tabletFilteringFields();
                $computers = ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']);
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
                if($this->isAdminSearching()) {
                    return view($searchItem['adminView'], [
                        'result' => $result, 'numResult' => $numResult
                    ]);
                } else {
                    return view($searchItem['clientView'], [
                        'result' => $result, 'numResult' => $numResult
                    ]);
                }
            } else {
                if($this->isAdminSearching()) {
                    return view($searchItem['adminView'], [
                        $searchItem['collection'] => ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']),
                        'noResults' => true
                    ]);
                } else {
                    return view($searchItem['clientView'], [
                        $searchItem['collection'] => ItemCatalogMapper::getInstance()->selectAllItemType($searchItem['itemType']),
                        'noResults' => true
                    ]);
                }
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
                    "quantity" => 0,
                    "width" => $sanitizedInputs['desktop-width'],
                    "height" => $sanitizedInputs['desktop-height'],
                    "thickness" => $sanitizedInputs['desktop-thickness'],
                ];
                $addDesktopItem = ItemCatalogMapper::getInstance();
                $addDesktopItem->addNewItem($_SESSION['session_id'], Controller::DESKTOP_ITEM_TYPE, $params); // ufw
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
                    "quantity" =>0
                ];
                $addLaptopItem = ItemCatalogMapper::getInstance();
                $addLaptopItem->addNewItem($_SESSION['session_id'], Controller::LAPTOP_ITEM_TYPE, $laptopItem); // ufw
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
                    "quantity" => 0,
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
                $addTabletItem->addNewItem($_SESSION['session_id'], Controller::TABLET_ITEM_TYPE, $params); // ufw
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
                return redirect()->back()->with([
                    'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE),
                    'inputErrors' => $emptyArrayKeys
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
                    "quantity" => 0,
                    "height" => $sanitizedInputs["desktop-height"],
                    "width" => $sanitizedInputs["desktop-width"],
                    "thickness" => $sanitizedInputs["desktop-thickness"]
                ];
                $desktopItem = ItemCatalogMapper::getInstance();
                $desktopItem->modifyItem($_SESSION['session_id'], $id, $params);
                $desktopItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE),
                    'itemSuccessfullyModified' => 'desktop'
                ]);
            }
        } else {
            return view('items.computer.show-desktop', [
                'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE)
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
                return redirect()->back()->with([
                    'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE),
                    'inputErrors' => $emptyArrayKeys
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
                    "quantity" => 0,
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
                    'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE),
                    'itemSuccessfullyModified' => 'laptop'
                ]);
            }
        } else {
            return view('items.computer.show-laptop', [
                'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE)
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
                return redirect()->back()->with([
                    'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE),
                    'inputErrors' => $emptyArrayKeys
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
                    "quantity" =>0,
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
                    'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE),
                    'itemSuccessfullyModified' => 'tablet'
                ]);
            }
        } else {
            return view('items.computer.show-tablet', [
                'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE)
            ]);
        }
    }

    public function addDesktopUnits()
    {
        $numOfUnits = $_POST['numOfUnits'];
        $itemID = $_POST['desktop-id'];
        $units = array();
        for ($i = 0; $i < $numOfUnits; $i++) {
            $units[$i] = new Unit($_POST['serial' . $i], $itemID, "AVAILABLE", "", "", "", "");
        }
        $unitMapper = UnitMapper:: getInstance();
        foreach ($units as $unit) {
            $unitMapper->create($_SESSION['session_id'], $unit->getSerial(), $unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);
        }
    }

    /**
     * for tablet units
     */
    public function addTabletUnits()
    {
        $numOfUnits = $_POST['numOfUnits'];
        $itemID = $_POST['tablet-id'];
        $units = array();
        $accountId = null;
        for ($i = 0; $i < $numOfUnits; $i++) {
            $units[$i] = new Unit($_POST['serial' . $i], $itemID, "AVAILABLE", "", "", "", "");
        }
        $unitMapper = UnitMapper:: getInstance();
        foreach ($units as $unit) {
            $unitMapper->create($_SESSION['session_id'], $unit->getSerial(), $unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);
        }
    }
}

