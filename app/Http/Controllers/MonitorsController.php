<?php

namespace App\Http\Controllers;
use App\Gateway\MonitorGateway;
use Illuminate\Http\Request;
require __DIR__ . '../../../gateway/MonitorGateway.php';
class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {
        return view('items.monitor.show-monitor');
    }


    public function insert(){

        $quantity = $_POST['this-monitor-qty'];
        $brand = $_POST['monitor-brand'];
        $price = $_POST['monitor-price'];
        $display_size = $_POST['monitor-display-size'];
        $monitor_weight = $_POST['monitor-weight'];

        $monitor_array = [$quantity,$brand,$price,$display_size,$monitor_weight];

        $monitor = new MonitorGateway();
        $item = [
            "category" => "monitor",
            "brand" => $brand,
            "price" => $price,
            "quantity" => $quantity,
            "display_size" => $display_size,
            "weight" => $monitor_weight
        ];
        $monitor->insert($item);
        echo "inserted";
    }
}