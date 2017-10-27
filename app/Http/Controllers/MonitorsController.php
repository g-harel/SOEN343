<?php

namespace App\Http\Controllers;

use App\Gateway\MonitorGateway;
use Illuminate\Http\Request;

require __DIR__ . '../../../gateway/MonitorGateway.php';

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
        $args = [ // backend validation
            'monitor-qty' => array('filter' => FILTER_VALIDATE_INT,
                'options' => array('min_range' => 1, 'max_range' => 100)
            ),
            'monitor-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'monitor-price' => $this->filterInputFloatArr,
            'monitor-display-size' => $this->filterInputFloatArr,
            'monitor-weight' => $this->filterInputFloatArr
        ];
        $sanitizedInputs = filter_input_array(INPUT_POST, $args);
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
            return view('items.create', ['insertedSuccessfully' => true, 'for' => 'monitor']);
        }

    }
}