<?php

namespace App\Http\Controllers;

use App\Gateway\DesktopGateway;
use App\Gateway\MonitorGateway;
use App\Gateway\UnitGateway;
use App\Mappers\ItemCatalogMapper;
use App\Mappers\UnitCatalog;
use App\Mappers\UnitMapper;
use App\Models\Desktop;
use App\Models\Unit;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {
        return view('items.monitor.show-monitor', [
            'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE)
        ]);
    }

    public function reserveMonitorUnit(){
        $serial = $_POST['serial'];
        $transactionID = $_SESSION['session_id'];
        $accountID  = $_SESSION['currentLoggedInId'];
        $id = $_POST['monitor-id'];
        $timestamp = '"'.date('Y-m-d G:i:s').'"';
        $unitGateway = UnitGateway::getInstance();
        $unitGateway->update($serial, $id, 'RESERVED', $accountID,$timestamp , 0, $timestamp);
    }
    public function addMonitorUnits(){

        $numOfUnits = $_POST['numOfUnits'];
        $itemID = $_POST['monitor-id'];
        $units = array();
        $item = new MonitorGateway();
        $arr  = $item->getByCondition([]);
        //$cata = UnitCatalog::getInstance();
        /*echo '<pre>';
        print_r($arr);
        print_r($arr2);
        die;*/
        for($i = 0; $i< $numOfUnits; $i++){
            $units[$i] = new Unit($_POST['serial'.$i],$itemID,"Available",'',"","","");
        }
        $unitMapper =  UnitMapper :: getInstance();
        foreach($units as $unit){
            $unitMapper->create($_SESSION['session_id'],$unit->getSerial(),$unit->getItemID());
            $unitMapper->commit($_SESSION['session_id']);

        }
    }
    public function searchMonitor()
    {
        if ($this->isFormSubmitted($_GET)) {
            $brand = filter_input(INPUT_GET, 'monitor-brand');
            $displaySize = filter_input(INPUT_GET, 'monitor-display-size');
            $maxPrice = filter_input(INPUT_GET, 'max-price');
            $minPrice = filter_input(INPUT_GET, 'min-price');
            //$monitors = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE);
            $item = new MonitorGateway();
            $arr  = $item->getByCondition([]);
            $monitors = array();
            $count = 0 ;
            for($i = 0; $i < count($arr);$i++){
                for($j = 0; $j < $arr[$i]['quantity'];$j++){
                    array_push($monitors,$arr[$i]);
                }
            }
            $result = array();
            foreach ($monitors as $monitor) {
                if ($maxPrice == 0) {
                    if ($monitor['price'] > $minPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['display_size'] == $displaySize || $displaySize == "")
                        ) {
                            array_push($result, $monitor);
                        }
                    }
                } else if ($maxPrice > 0) {
                    if ($monitor['price'] > $minPrice && $monitor['price'] < $maxPrice) {
                        if (($monitor['brand'] == $brand || $brand == "") &&
                            ($monitor['display_size'] == $displaySize || $displaySize == "")
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
                        'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE),
                        'noResults' => true
                    ]);
                } else {
                    return view('pages.viewMonitor', [
                        'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE),
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
                    "quantity" => 0,
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
                    "category" => "monitor",
                    "brand" => $sanitizedInputs['monitor-brand'],
                    "price" => $sanitizedInputs['monitor-price'],
                    "quantity" => 0,
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