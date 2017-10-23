<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\MonitorMapper;
use Illuminate\Support\Facades\DB;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {

        $monitorMapper = new MonitorMapper();
        $monitors = DB::select($monitorMapper->getMonitors());

        return view('items.monitor.show-monitor', ['monitors' => $monitors]);
    }
}