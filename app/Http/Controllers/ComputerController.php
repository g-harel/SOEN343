<?php

namespace App\Http\Controllers;
require __DIR__ . '../../../gateway/ItemGateway.php';
require __DIR__ . '../../../gateway/DatabaseGateway.php';
require __DIR__ . '../../../gateway/DesktopGateway.php';
require __DIR__ . '../../../gateway/TabletGateway.php';

use App\Gateway;
use App\Models;
use App\Gateway\DatabaseGateway;
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

        $desktopItem = [
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
        $desktopGateway = new DesktopGateway();
        $desktopGateway->insert($desktopItem);
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

    public function deleteDesktop() {
        // get the id from the form
        $itemId = $_POST['item-id'];
        $itemQty = $_POST['qty-to-remove'];
        $newQty = null;
        // return a single desktop item
        $desktopResult = Gateway\singleTableSelectUserQuery(["item_id" => $itemId], "desktops");
        if($desktopResult != null || !empty($desktopResult)) {
            $computerResult = Gateway\singleTableSelectUserQuery(["item_id" => $desktopResult[0]["item_id"]], "computers");
            $itemResult = Gateway\singleTableSelectUserQuery(["id" => $desktopResult[0]["item_id"]], "items");
            // compare input values from form and the id
            if ($itemResult[0]["id"] == $itemId) {
                $desktopUpdate = new DesktopGateway();
                $newQty = ($itemResult[0]["quantity"] - $itemQty);
                $desktopItem = [
                    "id" => $itemId,
                    "processor_type" => $computerResult[0]["processor_type"],
                    "ram_size" => $computerResult[0]["ram_size"],
                    "cpu_cores" => $computerResult[0]["cpu_cores"],
                    "weight" => $computerResult[0]["weight"],
                    "type" => $computerResult[0]["type"],
                    "category" => $itemResult[0]["category"],
                    "brand" => $itemResult[0]["brand"],
                    "price" => $itemResult[0]["price"],
                    "quantity" => $newQty,
                    "height" => $desktopResult[0]["height"],
                    "width" => $desktopResult[0]["width"],
                    "thickness" => $desktopResult[0]["thickness"]
                ];
                $desktopUpdate->update($desktopItem);
                echo 'updated!';
            }
        }
    }
}

