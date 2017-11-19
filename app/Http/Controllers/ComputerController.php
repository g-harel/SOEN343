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

    public function search() {
        if ($this->isFormSubmitted($_GET)) {
            $params = []; $computers = []; $result = [];
            $specs = ['blade' => null, 'collection' => null, 'type' => null];
            if ($this->isAdminSearching()) {
                if (isset($_GET['admin-search-desktop-form'])) {
                    $params = $this->desktopSearchParams();
                    $computers = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE);
                    $specs['blade'] = 'items.computer.show-desktop';
                    $specs['collection'] = 'desktops';
                } else if(isset($_GET['admin-search-laptop-form'])) {
                    $params = $this->laptopSearchParams();
                    $computers = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE);
                    $specs['blade'] = 'items.computer.show-laptop';
                    $specs['collection'] = 'laptops';
                } else if(isset($_GET['admin-search-tablet-form'])) {
                    $params = $this->tabletSearchParams();
                    $computers = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE);
                    $specs['blade'] = 'items.computer.show-tablet';
                    $specs['collection'] = 'tablets';
                }
            } else {
                if (isset($_GET['client-search-desktop-form'])) {
                    $params = $this->desktopSearchParams();
                    $computers = $this->returnItemUnits(Controller::DESKTOP_ITEM_TYPE);
                    $specs['blade'] = 'viewDesktop';
                    $specs['collection'] = 'desktops';
                } else if (isset($_GET['client-search-laptop-form'])) {
                    $params = $this->laptopSearchParams();
                    $computers = $this->returnItemUnits(Controller::LAPTOP_ITEM_TYPE);
                    $specs['blade'] = 'viewLaptop';
                    $specs['collection'] = 'laptops';
                } else if (isset($_GET['client-search-tablet-form'])) {
                    $params = $this->tabletSearchParams();
                    $computers =$this->returnItemUnits(Controller::TABLET_ITEM_TYPE);
                    $specs['blade'] = 'viewTablet';
                    $specs['collection'] = 'tablets';
                }
            }
            foreach ($computers as $computer) {
                if ($params['maxPrice'] == 0) {
                    if ($computer['price'] > $params['minPrice']) {
                        if (($computer['brand'] == $params['brand'] || $params['brand'] == "") &&
                            ($computer['hddSize'] == $params['storage'] || $params['storage'] == "") &&
                            ($computer['ramSize'] == $params['ramSize'] || $params['ramSize'] == "")
                        ) {

                            array_push($result, $computer);
                        }
                    }
                } else if ($params['maxPrice'] > 0) {
                    if ($computer['price'] > $params['minPrice'] && $computer['price'] < $params['maxPrice']) {
                        if (($computer['brand'] == $params['brand'] || $params['brand'] == "") &&
                            ($computer['hddSize'] == $params['storage'] || $params['storage'] == "") &&
                            ($computer['ramSize'] == $params['ramSize'] || $params['ramSize'] == "")
                        ) {

                            array_push($result, $computer);
                        }
                    }
                }
            }
            $numResult = count($result);
            if($this->isAdminSearching()) {
                if ($numResult > 0) {
                    return view($specs['blade'], ['result' => $result, 'numResult' => $numResult]);
                }
                return view($specs['blade'], [$specs['collection'] => $computers, 'noResults' => true]);
            } else {
                if ($numResult > 0) {
                    return view($specs['blade'], ['result' => $result, 'numResult' => $numResult]);
                }
                return view($specs['blade'], [$specs['collection'] =>  $computers, 'noResults' => true]);
            }
            return view($specs['blade'], [$specs['collection'] =>  $computers, 'noResults' => true]);
        }

        return view('pages.view');
    }

    public function redirectionSearchResults($specs, $result, $computers) {
        $numResult = count($result);
        if($this->isAdminSearching()) {
            if ($numResult > 0) {
                return view($specs['blade'], ['result' => $result, 'numResult' => $numResult]);
            }
            return view($specs['blade'], [$specs['collection'] => $computers, 'noResults' => true]);
        } else {
            if ($numResult > 0) {
                return view($specs['blade'], ['result' => $result, 'numResult' => $numResult]);
            }
            return view($specs['blade'], [$specs['collection'] =>  $computers, 'noResults' => true]);
        }
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
        $cond = true;
        if ($cond) {
            return redirect()->back()->with(['unitsAdded' => true]);
        } else {
            return redirect()->back()->with(['unitsNotAdded' => true]);
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
        for ($i = 0; $i < $numOfUnits; $i++) {
            $units[$i] = new Unit($_POST['serial' . $i], $itemID, "AVAILABLE", "", "", "", "");
        }
        $unitMapper = UnitMapper::getInstance();
        $cond = null;
        foreach ($units as $unit) {
            $unitMapper->create($_SESSION['session_id'], $unit->getSerial(), $unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);
        }
        $cond = true;
        if ($cond) {
            return redirect()->back()->with(['unitsAdded' => true]);
        } else {
            return redirect()->back()->with(['unitsNotAdded' => true]);
        }
    }

    public function addLaptopUnits()
    {
        $numOfUnits = $_POST['numOfUnits'];
        $itemID = $_POST['laptop-id'];
        $units = array();
        for ($i = 0; $i < $numOfUnits; $i++) {
            $units[$i] = new Unit($_POST['serial' . $i], $itemID, "Available", "", "", "", "");
        }
        $unitMapper = UnitMapper::getInstance();
        $cond = null;
        foreach ($units as $unit) {
            $unitMapper->create($_SESSION['session_id'], $unit->getSerial(), $unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);
        }
        $cond = true;
        if ($cond) {
            return redirect()->back()->with(['unitsAdded' => true]);
        } else {
            return redirect()->back()->with(['unitsNotAdded' => true]);
        }
    }

    public function reserveDesktopUnit()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1) {
            $serial = $_POST['serial'];
            $unitMapper = UnitMapper::getInstance();
            $unitMapper->reserve($_SESSION['session_id'], $serial, $_SESSION['currentLoggedInId']);
            $unitMapper->commit($_SESSION['session_id']);
            return redirect()->back()->with(['unitReserved' => true]);
        } else {
            return redirect()->back()->with(['unitNotReserved' => true]);
        }
    }

    public function reserveLaptopUnit()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1) {
            $serial = $_POST['serial'];
            $unitMapper = UnitMapper::getInstance();
            $unitMapper->reserve($_SESSION['session_id'], $serial, $_SESSION['currentLoggedInId']);
            $unitMapper->commit($_SESSION['session_id']);
            return redirect()->back()->with(['unitReserved' => true]);
        } else {
            return redirect()->back()->with(['unitNotReserved' => true]);
        }
    }

    public function reserveTabletUnit()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] != 1) {
            $serial = $_POST['serial'];
            $unitMapper = UnitMapper::getInstance();
            $unitMapper->reserve($_SESSION['session_id'], $serial, $_SESSION['currentLoggedInId']);
            $unitMapper->commit($_SESSION['session_id']);
            return redirect()->back()->with(['unitReserved' => true]);
        } else {
            return redirect()->back()->with(['unitNotReserved' => true]);
        }
    }
}

