<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\ItemCatalogMapper;

class ComputerController extends Controller
{

    public function index() {

    }

    public function showDesktop() {

        return view('items.computer.show-desktop', ['desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)]);
    }

    public function showLaptop() {

        $laptopMapper = new LaptopMapper();
        $laptops = $laptopMapper->getAll();

        return view('items.computer.show-laptop', ['laptops' => $laptops]);
    }

    public function showTablet() {

        $tabletMapper = new TabletMapper();
        $tablets = $tabletMapper->getAll();

        return view('items.computer.show-tablet', ['tablets' => $tablets]);
    }
}
