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
        if ($this->isFormSubmitted($_POST)) {
            $email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $login = new Login($email, $password);
            if ($login->validate() && $this->isAdminLoggedIn()) {
                // for admin redirection
                return view('pages.admin');
            } elseif ($login->validate() && !$this->isAdminLoggedIn()) {
                // for client redirection
                return view('pages.view');
            } else {
                return redirect()->back()->with(
                    'loginError', true
                );
            }
        }
        return view('pages.index');
    }

    public function registerUser() {
        // check if email exist
        // if not then you can add this user
        // return confirm message or error message

        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phoneNumber = $_POST['phone_number'];
        $doorNumber = $_POST['door_number'];
        $street = $_POST['street'];
        $appt = $_POST['appartment'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $country = $_POST['country'];
        $postalCode = $_POST['postal_code'];

        $registerThis = new Register($firstName, $lastName, $email, $password, $phoneNumber,
            $doorNumber, $street, $appt, $city, $province, $country, $postalCode);

        echo '<pre>';
        $registerThis->createUser();

        print_r($registerThis);


    }
}

