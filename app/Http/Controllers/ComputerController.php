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
use App\Gateway\LaptopGateway;


class ComputerController extends Controller
{
    public function index()
    {
    }

    public function showDesktop()
    {
        // syntax:
        // folderName.folderName.fileName.php
        return view('items.computer.show-desktop');
    }

    public function showLaptop()
    {
        return view('items.computer.show-laptop');
    }

    public function showTablet()
    {
        return view('items.computer.show-tablet');
    }

    public function insertDesktop()
    {
        $args = [ // backend validation
            'desktop-qty' => array('filter' => FILTER_VALIDATE_INT,
                'options' => array('min_range' => 1, 'max_range' => 100)
            ),
            'computer-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-ram-size' => FILTER_VALIDATE_INT,
            'storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'desktop-cpu-cores' => FILTER_VALIDATE_INT,
            'desktop-price' => FILTER_SANITIZE_NUMBER_FLOAT,
            'desktop-weight' => FILTER_VALIDATE_FLOAT,
            'desktop-height' => FILTER_VALIDATE_FLOAT,
            'desktop-width' => FILTER_VALIDATE_FLOAT,
            'desktop-thickness' => FILTER_VALIDATE_FLOAT
        ];
        $sanitizedInputs = filter_input_array(INPUT_POST, $args);
        // if one of the element values of $sanitizedInputs is empty,
        // then at least one or more values entered are invalid
        // display a message in view, otherwise continue inserting
        $emptyArrayKeys = array_keys($sanitizedInputs, "");
        if (!empty($emptyArrayKeys)) {
            return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
        } else {
            $desktopItem = [ // it is assumed all the values are good here, can now insert
                "processor_type" => $sanitizedInputs["desktop-processor"],
                "ram_size" => $sanitizedInputs["desktop-ram-size"],
                "cpu_cores" => $sanitizedInputs["desktop-cpu-cores"],
                "weight" => $sanitizedInputs["desktop-weight"],
                "type" => "desktop",
                "category" => "desktop",
                "brand" => $sanitizedInputs["computer-brand"],
                "price" => $sanitizedInputs["desktop-price"],
                "quantity" => $sanitizedInputs["desktop-qty"],
                "height" => $sanitizedInputs["desktop-height"],
                "width" => $sanitizedInputs["desktop-width"],
                "thickness" => $sanitizedInputs["desktop-thickness"]
            ];
            $desktopGateway = new DesktopGateway();
            $desktopGateway->insert($desktopItem);
            return view('items.create', ['insertedSuccessfully' => true, 'for' => 'desktop']);
        }
    }

    public function insertLaptop()
    {
        $args = [
            'laptop-qty' => array('filter' => FILTER_VALIDATE_INT,
                'options' => array('min_range' => 1, 'max_range' => 100)
            ),
            'laptop-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-ram-size' => FILTER_VALIDATE_INT,
            'laptop-storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-cpu-cores' => FILTER_VALIDATE_INT,
            'laptop-os' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-display-size' => FILTER_SANITIZE_NUMBER_FLOAT,
            'laptop-price' => FILTER_SANITIZE_NUMBER_FLOAT,
            'laptop-weight' => FILTER_VALIDATE_FLOAT,
            'laptop-battery' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'laptop-camera' => FILTER_SANITIZE_SPECIAL_CHARS,
            'laptop-touchscreen' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
        $sanitizedInputs = filter_input_array(INPUT_POST, $args);
        $emptyArrayKeys = array_keys($sanitizedInputs, "");
        if (!empty($emptyArrayKeys)) {
            return view('items.create', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
        } else {
            $laptopItem = [
                "processor_type" => $sanitizedInputs['laptop-processor'],
                "ram_size" => $sanitizedInputs['laptop-ram-size'],
                "cpu_cores" => $sanitizedInputs['laptop-cpu-cores'],
                "weight" => $sanitizedInputs['laptop-weight'],
                "type" => "laptop",
                "category" => "laptop",
                "brand" => $sanitizedInputs['laptop-brand'],
                "price" => $sanitizedInputs['laptop-price'],
                "quantity" => $sanitizedInputs['laptop-qty'],
                "display_size" => $sanitizedInputs['laptop-display-size'],
                //hard drive column not in database right now
                "os" => $sanitizedInputs['laptop-os'],
                "battery" => $sanitizedInputs['laptop-battery'],
                "camera" => $sanitizedInputs['laptop-camera'],
                "is_touchscreen" => $sanitizedInputs['laptop-touchscreen'],
            ];
            $laptopGateway = new LaptopGateway();
            $laptopGateway->insert($laptopItem);
            return view('items.create', ['insertedSuccessfully' => true, 'for' => 'laptop']);
        }
    }

    public function insertTablet()
    {
//        $args = [ // backend validation
//            'desktop-qty' => array('filter' => FILTER_VALIDATE_INT,
//                'options' => array('min_range' => 1, 'max_range' => 100)
//            ),
//            'computer-brand' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//            'desktop-processor' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//            'desktop-ram-size' => FILTER_VALIDATE_INT,
//            'storage-capacity' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//            'desktop-cpu-cores' => FILTER_VALIDATE_INT,
//            'desktop-price' => FILTER_SANITIZE_NUMBER_FLOAT,
//            'desktop-weight' => FILTER_VALIDATE_FLOAT,
//            'desktop-height' => FILTER_VALIDATE_FLOAT,
//            'desktop-width'  => FILTER_VALIDATE_FLOAT,
//            'desktop-thickness'  => FILTER_VALIDATE_FLOAT
//        ];


//        $tabletGateWay = new TabletGateway();
//        $tabletItem = [
//            "processor_type" => "Intel",
//            "ram_size" => 4,
//            "cpu_cores" => 4,
//            "weight" => 12,
//            "type" => "tablet", // important
//            "category" => "tablet", // important
//            "brand" => "apple",
//            "price" => 200,
//            "quantity" => 19,
//            "display_size" => 14,
//            "width" => 13,
//            "height" => 13,
//            "thickness" => 12,
//            "battery" => "hello",
//            "os" => "hello agian",
//            "camera" => "camera",
//            "is_touchscreen" => 1
//        ];
//        $tabletGateWay->insert($tabletItem);
//        echo 'inserted';
    }

    public function deleteDesktop()
    {
        // validate the id and the quantity in the modal
        $itemId = filter_input(INPUT_POST, 'item-id', FILTER_SANITIZE_SPECIAL_CHARS);
        $itemQty = filter_input(INPUT_POST, 'qty-to-remove', FILTER_VALIDATE_INT);
        $thisDesktop = Gateway\singleTableSelectUserQuery(["item_id" => $itemId], "desktops");
        if ($thisDesktop != null || !empty($thisDesktop)) {
            $newQty = null;
            $computer = Gateway\singleTableSelectUserQuery(["item_id" => $thisDesktop[0]["item_id"]], "computers");
            $item = Gateway\singleTableSelectUserQuery(["id" => $thisDesktop[0]["item_id"]], "items");
            if ($item[0]["id"] == $itemId) {
                $desktopUpdate = new DesktopGateway();
                // subtract the quantity entered with the old quantity
                $newQty = ($item[0]["quantity"] - $itemQty);
                // update function requires all fields to be present so
                $desktopItem = [
                    "id" => $item[0]["id"],
                    "processor_type" => $computer[0]["processor_type"],
                    "ram_size" => $computer[0]["ram_size"],
                    "cpu_cores" => $computer[0]["cpu_cores"],
                    "weight" => $computer[0]["weight"],
                    "type" => $computer[0]["type"],
                    "category" => $item[0]["category"],
                    "brand" => $item[0]["brand"],
                    "price" => $item[0]["price"],
                    "quantity" => $newQty,
                    "height" => $thisDesktop[0]["height"],
                    "width" => $thisDesktop[0]["width"],
                    "thickness" => $thisDesktop[0]["thickness"]
                ];
                $desktopUpdate->update($desktopItem);
                echo 'updated!';
            }
        } else {
            echo 'cannot update this item!';
        }
    }
}

