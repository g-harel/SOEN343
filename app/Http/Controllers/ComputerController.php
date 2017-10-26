<?php

namespace App\Http\Controllers;
use App\Gateway\LaptopGateway;
require __DIR__ . '../../../gateway/LaptopGateway.php';
use Illuminate\Http\Request;

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

    public function insertLaptop(){
        $laptopGateway = new LaptopGateway();

        $quantity = $_POST['this-laptop-qty'];
        $brand = $_POST['laptop-brand'];
        $price = $_POST['laptop-price'];
        $display_size = $_POST['laptop-display-size'];
        $laptop_weight = $_POST['laptop-weight'];
        $processor = $_POST['laptop-processor'];
        $ram = $_POST['laptop-ram-size'];
        $hdd = $_POST['laptop-storage-capacity'];
        $cores = $_POST['laptop-cpu-cores'];
        $os = $_POST['laptop-os'];
        $battery = $_POST['laptop-battery'];
        $camera = $_POST['laptop-camera'];
        $touchscreen = $_POST['laptop-touchscreen'];



        $laptopItem = [
            "processor_type" => $processor,
            "ram_size" => $ram,
            "cpu_cores" => $cores,
            "weight" => $laptop_weight,
            "type" => "laptop",
            "category" => "laptop",
            "brand" => $brand,
            "price" => $price,
            "quantity" => $quantity,
            "display_size" => $display_size,
            //hard drive column not in database right now
            "os" => $os,
            "battery" => $battery,
            "camera"  => $camera,
            "is_touchscreen" => $touchscreen,
        ];
        $laptopGateway->insert($laptopItem);
        echo 'inserted';
    }

}
