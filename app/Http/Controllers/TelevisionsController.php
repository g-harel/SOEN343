<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelevisionsController extends Controller
{
    // /items/tv
    public function index(){

    }

    public function showTv(){
        return view('items.tv.show-tv');
    }
}
