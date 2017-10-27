<?php

namespace App\Http\Controllers;

use App\Gateway\MonitorGateway;
use Illuminate\Http\Request;


class MonitorsController extends Controller
{
    public function index()
    {

    }

    public function showMonitor()
    {
        return view('items.monitor.show-monitor');
    }

    public function insertMonitor()
    {
        if($this->isFormSubmitted($_POST)) {
            $sanitizedInputs = filter_input_array(INPUT_POST, $this->monitorValidationFormInputs());
            // returns the key of empty index (eg. monitor-brand => "")
            $emptyArrayKeys = array_keys($sanitizedInputs, "");
            if (!empty($emptyArrayKeys)) {
                return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
            } else {
                $item = [
                    "category" => "monitor",
                    "brand" => $sanitizedInputs['monitor-brand'],
                    "price" => $sanitizedInputs['monitor-price'],
                    "quantity" => $sanitizedInputs['monitor-qty'],
                    "display_size" => $sanitizedInputs['monitor-display-size'],
                    "weight" => $sanitizedInputs['monitor-weight']
                ];
                $monitorGateway = new MonitorGateway();
                $monitorGateway->insert($item);
                // do not use render, use redirect, this prevent resubmitting
                return redirect()->back()->with(['succeedInsertingItem' => true, 'for' => 'monitor']);
            }
        } else {
            return view('items.create');
        }


    }
}