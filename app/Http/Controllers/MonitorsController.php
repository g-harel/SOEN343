<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\MonitorMapper;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {

        $monitorMapper = new MonitorMapper();
        $monitors = $monitorMapper->getMonitors();

        return view('items.monitor.show-monitor', ['monitors' => $monitors]);
    }
}