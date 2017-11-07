<?php

namespace App\Http\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Mappers\SessionMapper;
use App\Mappers\UserMapper;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function register()
    {
        return view('pages.register');
    }
  
    public function admin(){
        if($this->isAdminLoggedIn()) {
            return view('pages.admin');
        }
        return view('pages.index');
    }

    public function view(){
        return view('pages.view');
    }

    public function viewDesktop()
    {
        return view('pages.viewDesktop');
    }

    public function viewLaptop()
    {
        return view('pages.viewLaptop');
    }

    public function viewMonitor()
    {
        return view('pages.viewMonitor');
    }

    public function viewTablet()
    {
        return view('pages.viewTablet');
    }

    public function monitorDetails($id)
    {
        return view('pages.viewMonitor')->with('id', $id);
    }

    public function desktopDetails($id)
    {
        return view('pages.viewDesktop')->with('id', $id);
    }

    public function laptopDetails($id)
    {
        return view('pages.viewLaptop')->with('id', $id);
    }

    public function tabletDetails($id)
    {
        return view('pages.viewTablet')->with('id', $id);
    }

    public function login(){
        return view('pages.login');
    }

    public function logout()
    {
        // on log out close session item in session table as well
        $sessionMapper = new SessionMapper();
        if(isset($_SESSION['currentLoggedInId'])) {
            $sessionMapper->closeSession($_SESSION['currentLoggedInId']);
        }
        $_SESSION = array();
        session_destroy();
        return view('pages.login');
    }

    public function registerVerification()
    {
        return view('pages.registerVerification');
    }

    public function shoppingCart()
    {
        if ($this->isAdminLoggedIn()) {
            return view('pages.admin');
        }
        return view('pages.shoppingCart');
    }

    public function loginVerify()
    {
        if (!empty($_POST)) {
            $email = $_POST['username'];
            $password = $_POST['password'];
            $userMapper = new UserMapper();
            if ($userMapper->isUserExist($email, $password)) {
                // set the session
                $_SESSION['isAdmin'] = $userMapper->getUserByEmail($email)[0]['isAdmin'];
                $_SESSION['currentLoggedInId'] = $userMapper->getUserByEmail($email)[0]['id'];
                $userId = $_SESSION['currentLoggedInId'];
                // and populate session table
                $sessionMapper = new SessionMapper();
                $sessionMapper->openSession2($userId);
                if ($this->isAdminLoggedIn()) {
                    return view('pages.admin');
                } else {
                    return view('pages.view');
                }
            } else {
                return redirect()->back()->with(
                    'loginError', 'Password or email is not correct. Please try again or register a new account.'
                );
            }
        }
        return view('pages.index');
    }

    /**
     * Return true if the user
     * currently logged is an
     * admin
     * @return bool
     */
    public function isAdminLoggedIn() {
        return isset($_SESSION) && !empty($_SESSION) && $_SESSION['isAdmin'] == 1;
    }
}

