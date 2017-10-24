<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\LaptopMapper;
use App\Mappers\DesktopMapper;
use App\Mappers\TabletMapper;

class ComputerController extends Controller
{

    public function index() {

    }

    public function showDesktop() {
        // syntax:
        // folderName.folderName.fileName.php
        $desktopMapper = new DesktopMapper();
        $desktops = $desktopMapper->getAllDesktops();

        return view('items.computer.show-desktop', ['desktops'=> $desktops]);
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
