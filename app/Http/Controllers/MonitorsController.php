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
        $monitor = new MonitorGateway();
        $item = [
            "category" => "monitor",
            "brand" => "apple",
            "price" => 200,
            "quantity" => $_POST['this-monitor-qty'],
            "display_size" => 12,
            "weight" => 2
        ];
        $monitor->insert($item);
        echo "inserted";
    }
}