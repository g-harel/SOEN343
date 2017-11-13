<?php

namespace App\Http\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Gateway\MonitorGateway;
use Illuminate\Http\Request;
use App\Mappers\ItemCatalogMapper;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {
        return view('items.monitor.show-monitor', ['monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)]);
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
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'monitor']);
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
            // returns the key of empty index (eg. monitor-brand => "")
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.monitor.show-monitor', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
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
                $addTabletItem = ItemCatalogMapper::getInstance();
                $addTabletItem->modifyItem($_SESSION['session_id'], 1, $params);
                $addTabletItem->commit($_SESSION['session_id']);
                return view('items.monitor.show-monitor', [
                    'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1),
                    'succeedModifyingItem' => 'monitor'
                ]);
            }
        } else {
            return view('items.monitor.show-monitor', ['monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)]);
        }
    }

    public function deleteMonitor() {
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
}