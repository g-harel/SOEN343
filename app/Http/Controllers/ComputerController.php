<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\LaptopMapper;

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

        $laptopMapper = new LaptopMapper();
        $laptops = $laptopMapper->getAllLaptops();

        return view('items.computer.show-laptop', ['laptops' => $laptops]);
    }

    public function showTablet() {
        return view('items.computer.show-tablet');
    }
}
