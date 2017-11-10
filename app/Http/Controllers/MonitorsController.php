<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\ItemCatalogMapper;

class MonitorsController extends Controller
{
    public function index(){

    }

    public function showMonitor() {

        return view('items.monitor.show-monitor', ['monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)]);
    }
}