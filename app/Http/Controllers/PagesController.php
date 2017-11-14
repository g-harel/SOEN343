<?php

namespace App\Http\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Mappers\SessionMapper;
use App\Mappers\AccountCatalogMapper;

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

        $sanitizedInputs = filter_input_array(INPUT_POST, $this->registerValidateFormInputs());
        $emptyArrayKeys = array_keys($sanitizedInputs, "");


        if (!empty($emptyArrayKeys)) {
            return view('pages.register', ['inputErrors' => $emptyArrayKeys, 'alertType' => 'warning']);
        } else {
            $registerThis = new Register($sanitizedInputs['first_name'], $sanitizedInputs['last_name'], $sanitizedInputs['email'],
                $sanitizedInputs['password'], $sanitizedInputs['phone_number'],
                $sanitizedInputs['door_number'], $sanitizedInputs['street'], $_POST['appartment'], $sanitizedInputs['city'],
                $sanitizedInputs['province'], $sanitizedInputs['country'], $sanitizedInputs['postal_code']);

            $exists = $registerThis->checkExistingEmail();

            if($exists){
                return redirect()->back()->with(['emailExists' => true, 'for' => 'laptop']);
            }
            else{
                $registerThis->createUser();
            }
            return view('pages.view');
        }

    }

    public function clients()
    {
        $accountCatalog = new AccountCatalogMapper();
        return view('pages.clients', ['clients' => $accountCatalog->getAllAccounts()]);
    }
}

