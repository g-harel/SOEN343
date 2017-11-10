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

        return view('items.computer.show-laptop', ['laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)]);
    }

    public function showTablet() {

        return view('items.computer.show-tablet', ['tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)]);
    }
}
