<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    public function index()
    {
        return view('items.index');
    }

    public function create()
    {
        return view('items.create');
    }

}