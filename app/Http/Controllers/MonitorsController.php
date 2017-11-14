<?php

namespace App\Http\Controllers;

use App\Mappers\ItemCatalogMapper;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {
        return view('items.monitor.show-monitor', [
            'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)
        ]);
    }

    public function searchMonitor()
    {
        if ($this->isFormSubmitted($_GET)) {
            $brand = filter_input(INPUT_GET, 'monitor-brand');
            $displaySize = filter_input(INPUT_GET, 'monitor-display-size');
            $maxPrice = filter_input(INPUT_GET, 'max-price');
            $minPrice = filter_input(INPUT_GET, 'min-price');
            $monitors = ItemCatalogMapper::getInstance()->selectAllItemType(1);
            $result = array();
            foreach ($monitors as $monitor) {
                if ($maxPrice == 0) {
                    if ($monitor['price'] > $minPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['displaySize'] == $displaySize || $displaySize == "")
                        ) {
                            array_push($result, $monitor);
                        }
                    }
                } else if ($maxPrice > 0) {
                    if ($monitor['price'] > $minPrice && $monitor['price'] < $maxPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['displaySize'] == $displaySize || $displaySize == "")
                        ) {
                            array_push($result, $monitor);
                        }
                    }
                }
            }
            if (!empty($result)) {
                $numResult = count($result);
                if($this->isAdminSearching()) {
                    return view('items.monitor.show-monitor', [
                        'result' => $result, 'numResult' => $numResult
                    ]);
                } else {
                    return view('pages.viewMonitor', [
                        'result' => $result, 'numResult' => $numResult
                    ]);
                }
            } else {
                if($this->isAdminSearching()) {
                    return view('items.monitor.show-monitor', [
                        'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1),
                        'noResults' => true
                    ]);
                } else {
                    return view('pages.viewMonitor', [
                        'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1),
                        'noResults' => true
                    ]);
                }
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
                    "quantity" => $sanitizedInputs['monitor-qty'],
                    "displaySize" => $sanitizedInputs['monitor-display-size'],
                ];

                $addMonitorItem = ItemCatalogMapper::getInstance();
                $addMonitorItem->addNewItem($_SESSION['session_id'], 1, $params); // ufw
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
                    'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1),
                    'inputErrors' => $emptyArrayKeys
                ]);
            } else {
                $params = [
                    "id" => $id,
                    "category" => "monitor",
                    "brand" => $sanitizedInputs['monitor-brand'],
                    "price" => $sanitizedInputs['monitor-price'],
                    "quantity" => $sanitizedInputs['monitor-qty'],
                    "displaySize" => $sanitizedInputs['monitor-display-size'],
                    "weight" => $sanitizedInputs['monitor-weight']
                ];
                $monitorItem = ItemCatalogMapper::getInstance();
                $monitorItem->modifyItem($_SESSION['session_id'], $id, $params);
                $monitorItem->commit($_SESSION['session_id']);
                return redirect()->back()->with([
                    'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1),
                    'itemSuccessfullyModified' => 'monitor'
                ]);
            }
        } else {
            return view('items.monitor.show-monitor', [
                'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)
            ]);
        }
    }

    public function deleteMonitor() {
        if($this->isFormSubmitted($_POST)) {
            $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($itemId)) {
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