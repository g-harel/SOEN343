<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {
        return view('items.monitor.show-monitor');
    }
}