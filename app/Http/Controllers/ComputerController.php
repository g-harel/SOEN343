<?php

namespace App\Http\Controllers;
require __DIR__ . '../../../gateway/DesktopGateway.php';
require __DIR__ . '../../../gateway/TabletGateway.php';

use App\Gateway\DesktopGateway;
use App\Gateway\TabletGateway;




class ComputerController extends Controller
{
    public function index() {}

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

        $args = array(
            'this-desktop-qty'   => array('filter'=> FILTER_VALIDATE_INT,
                'options'   => array('min_range' => 1)
            ),
//            'computer-brand' =>
        );

        $myinputs = filter_input_array(INPUT_POST, $args);
        echo $myinputs['this-desktop-qty'];
//        print_r($myinputs);


//
//        $desktopItem = [
//            "processor_type" => "Intel",
//            "ram_size" => 4,
//            "cpu_cores" => 4,
//            "weight" => 1,
//            "type" => "desktop",
//            "category" => "desktop",
//            "brand" => "apple",
//            "price" => 200,
//            "quantity" => 19,
//            "height" => 12,
//            "width" => 12,
//            "thickness" => 14
//        ];
//        $desktopGateway = new DesktopGateway();
//        $desktopGateway->insert($desktopItem);
        echo 'inserted';
    }

    public function insertTablet() {
        $tabletGateWay = new TabletGateway();
        $tabletItem = [
            "processor_type" => "Intel",
            "ram_size" => 4,
            "cpu_cores" => 4,
            "weight" => 12,
            "type" => "tablet", // important
            "category" => "tablet", // important
            "brand" => "apple",
            "price" => 200,
            "quantity" => 19,
            "display_size" => 14,
            "width" => 13,
            "height" => 13,
            "thickness" => 12,
            "battery" => "hello",
            "os" => "hello agian",
            "camera" => "camera",
            "is_touchscreen" => 1
        ];

        $tabletGateWay->insert($tabletItem);
        echo 'inserted';

    }
}

