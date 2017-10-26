<?php

namespace App\Http\Controllers;
require __DIR__ . '../../../gateway/ComputerGateway.php';

use Illuminate\Http\Request;
use App\Gateway\ComputerGateway;

class ComputerController extends Controller
{

    public function index() {

    }

    public function showDesktop() {
        // syntax:
        // folderName.folderName.fileName.php
        return view('items.computer.show-desktop');
    }

    public function showLaptop() {
        return view('items.computer.show-laptop');
    }

    public function showTablet() {
        return view('items.computer.show-tablet');
    }

    public function insertDesktop() {
        $computer = new ComputerGateway();
        /**
         * order of item
         * 1. computers
         * 2. items
         * 3. desktop
         */
        $computerItem = [
            "processor_type" => "Intel",
            "ram_size" => 4,
            "cpu_cores" => 4,
            "weight" => 1,
            "type" => "desktop",
            "category" => "desktop",
            "brand" => "apple",
            "price" => 200,
            "quantity" => 19,
            "height" => 12,
            "width" => 12,
            "thickness" => 14
        ];
        $computer->insert($computerItem);
        echo 'inserted';

    }

    public function insertTablet() {

        $tabletItem = [
            "processor_type" => "Intel",
            "ram_size" => 4,
            "cpu_cores" => 4,
            "weight" => 1,
            "type" => "desktop",
            "category" => "desktop",
            "brand" => "apple",
            "price" => 200,
            "quantity" => 19, // end items
            "height" => 12,
            "width" => 12,
            "thickness" => 14
        ];

    }
}
