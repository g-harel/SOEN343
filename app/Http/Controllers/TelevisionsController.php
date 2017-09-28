<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelevisionsController extends Controller
{
    // /items/tv
    public function index(){

    }

    public function showTvHd(){
        return view('items.tv.show-tv-hd');
    }

    public function showTvThreeD(){
        return view('items.tv.show-tv-three-d');
    }

    public function showTvLed(){
        return view('items.tv.show-tv-led');
    }

    public function showTvSmart(){
        return view('items.tv.show-tv-smart');
    }
}
