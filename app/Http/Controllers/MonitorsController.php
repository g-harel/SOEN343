<?php

namespace App\Http\Controllers;

use App\Mappers\ItemCatalogMapper;
use App\Mappers\UnitMapper;
use App\Models\Unit;

class MonitorsController extends Controller
{
    public function index()
    {

    }

    public function showMonitor()
    {
        return view('items.monitor.show-monitor', [
            'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE)
        ]);
    }

    public function reserveMonitorUnit()
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

    public function addMonitorUnits()
    {
        $numOfUnits = $_POST['num-of-units'];
        $itemID = $_POST['item-id'];
        $units = [];
        for ($i = 0; $i < $numOfUnits; $i++) {
            $units[$i] = new Unit($_POST['serial' . $i], $itemID, "Available", '', "", "", "");
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

    public function searchMonitor()
    {
        if ($this->isFormSubmitted($_GET)) {
            $brand = filter_input(INPUT_GET, 'monitor-brand');
            $displaySize = filter_input(INPUT_GET, 'monitor-display-size');
            $maxPrice = filter_input(INPUT_GET, 'max-price');
            $minPrice = filter_input(INPUT_GET, 'min-price');
            if ($this->isAdminSearching()) {
                $monitorsToSearch = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE);
            } else {
                $monitorsToSearch = $this->returnItemUnits(Controller::MONITOR_ITEM_TYPE);
            }
            $result = [];
            foreach ($monitorsToSearch as $monitor) {
                if ($maxPrice == 0) {
                    if ($monitor['price'] >= $minPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['displaySize'] == $displaySize || $displaySize == "")
                        ) {
                            array_push($result, $monitor);
                        }
                    }
                } else if ($maxPrice > 0) {
                    if ($monitor['price'] > $minPrice && $monitor['price'] <= $maxPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['displaySize'] == $displaySize || $displaySize == "")
                        ) {
                            array_push($result, $monitor);
                        }
                    }
                }
            }
            $numResult = count($result);
            if ($this->isAdminSearching()) {
                if ($numResult > 0) {
                    return view('items.monitor.show-monitor', [
                        'searchResult' => $result, 'numResult' => $numResult
                    ]);
                }
                return view('items.monitor.show-monitor', [
                    'noResults' => true,
                    'monitors' => $monitorsToSearch, 'numResult' => $numResult
                ]);
            } else {
                if ($numResult > 0) {
                    return view('pages.viewMonitor', [
                        'clientSearchResult' => $result, 'numResult' => $numResult
                    ]);
                }
                return view('pages.viewMonitor', [
                    'monitors' => $monitorsToSearch,
                    'noResults' => true
                ]);
            }
        }
        return view('pages.view');
    }

    public function insertMonitor()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->monitorValidationFormInputs());
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $params = [
                    "weight" => $sanitizedInputs['monitor-weight'],
                    "category" => "monitor",
                    "brand" => $sanitizedInputs['monitor-brand'],
                    "price" => $sanitizedInputs['monitor-price'],
                    "quantity" => 0,
                    "isDeleted" => 0,
                    "model" => 'MON-'.$sanitizedInputs['monitor-model'],
                    "displaySize" => $sanitizedInputs['monitor-display-size'],
                ];
                $addMonitorItem = ItemCatalogMapper::getInstance();
                $addMonitorItem->addNewItem($_SESSION['session_id'], Controller::MONITOR_ITEM_TYPE, $params); // ufw
                $addMonitorItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'itemSuccessfullyAdded' => true,
                    'for' => 'monitor',
                    'link' => 'monitor/showMonitor'
                ]);
            }
        } else {
            return view('items.create');
        }
    }

    public function modifyMonitor()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->monitorValidationFormInputs());
            $id = filter_input(INPUT_POST, 'monitor-id', FILTER_VALIDATE_INT);
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return redirect()->back()->with([
                    'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE),
                    'inputErrors' => $emptyArrayKeys
                ]);
            } else {
                $params = [
                    "id" => $id,
                    "model" => 'MON-'.$sanitizedInputs['monitor-model'],
                    "category" => "monitor",
                    "brand" => $sanitizedInputs['monitor-brand'],
                    "price" => $sanitizedInputs['monitor-price'],
                    "quantity" => 0,
                    "isDeleted" => 0,
                    "displaySize" => $sanitizedInputs['monitor-display-size'],
                    "weight" => $sanitizedInputs['monitor-weight']
                ];
                $monitorItem = ItemCatalogMapper::getInstance();
                $monitorItem->modifyItem($_SESSION['session_id'], $id, $params);
                $monitorItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE),
                    'itemSuccessfullyModified' => 'monitor'
                ]);
            }
        } else {
            return view('items.monitor.show-monitor', [
                'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE)
            ]);
        }
    }

    public function deleteMonitor()
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

}