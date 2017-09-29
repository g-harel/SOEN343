<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Soen 343';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'This is the about page';
        return view('pages.about')->with('title', $title);
    }

    public function register(){
        $title = 'Register';
        return view('pages.register')->with('title', $title);
    }
  
    public function admin(){
        $title = 'Welcome to the Admin page';
        return view('pages.admin')->with('title',$title);
    }

    public function login(){
        $title = 'Login';
        return view('pages.login')->with('title', $title);
    }

    public function loginAdminVerification(){
        return view('pages.loginAdminVerification');
    }
	
	public function loginClientVerification(){
        return view('pages.loginClientVerification');
    }
}

