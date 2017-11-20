<?php

namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\ItemCatalogMapper;
use App\Mappers\AccountMapper;
use App\Mappers\UnitMapper;

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

    public function admin()
    {
        return view('pages.admin');
    }

    public function purchaseHistory(){
        return view('pages.purchaseHistory');
    }
    
    public function view()
    {
        return view('pages.view');
    }

    public function viewDesktop()
    {
        $desktops = $this->returnItemUnits(3);
//        print_r($desktops);
        return view('pages.viewDesktop', [
            'desktops' => $desktops
        ]);
    }

    public function viewLaptop()
    {
        return view('pages.viewLaptop', [
            'laptops' => $this->returnItemUnits(4)
        ]);
    }

    public function viewMonitor()
    {
        $monitors = $this->returnItemUnits(1);
        return view('pages.viewMonitor', [
            'monitors' => $monitors
        ]);
    }

    public function viewTablet()
    {
        $tablets = $this->returnItemUnits(5);
        return view('pages.viewTablet', [
            'tablets' => $tablets
        ]);
    }

    public function monitorDetails($id)
    {
        $monitors = $this->returnItemUnits(1);
        $details = [];
        if($this->isIdExistInCatalog2($id, $monitors)) {
            foreach($monitors as $monitor){
                $details = $monitor;
            }
            return view('pages.viewMonitor', [
                'details' => $details,
            ]);
        } else {
            return redirect()->back()->with([
                'notFound' => true
            ]);
        }
    }

    public function desktopDetails($id)
    {
        $details = [];
        if($this->isIdExistInCatalog($id, Controller::DESKTOP_ITEM_TYPE)) {
            $desktops = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE);
            foreach($desktops as $desktop){
                $details = $desktop;
            }
            return view('pages.viewDesktop', [
                'details' => $details,
            ]);
        } else {
            return redirect()->back()->with([
                'notFound' => true
            ]);
        }

    }

    public function laptopDetails($id)
    {
        $details = [];
        if($this->isIdExistInCatalog($id, Controller::LAPTOP_ITEM_TYPE)) {
            $laptops = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE);
            foreach($laptops as $laptop){
                $details = $laptop;
            }
            return view('pages.viewLaptop', [
                'details' => $details
            ]);
        } else {
            return redirect()->back()->with([
                'notFound' => true
            ]);
        }
    }

    public function tabletDetails($id)
    {
        $details = [];
        if($this->isIdExistInCatalog($id, Controller::TABLET_ITEM_TYPE)) {
            $tablets = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE);
            foreach($tablets as $tablet){
                $details = $tablet;
            }
            return view('pages.viewLaptop', [
                'details' => $details
            ]);
        } else {
            return redirect()->back()->with([
                'notFound' => true
            ]);
        }
    }

    public function login()
    {
        return view('pages.login');
    }

    public function logout()
    {
        // on log out close session item in session table as well
        $sessionMapper = new SessionMapper();
        if (isset($_SESSION['currentLoggedInId'])) {
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
        $cart = UnitMapper::getInstance();

        $units = $cart->getCart($_SESSION['currentLoggedInId']);
        $itemMapper = ItemCatalogMapper::getInstance();

        $specs = [];
        foreach ($units as $unit) {
            array_push($specs, $itemMapper->getItem($unit['item_id']));
        }
//        echo '<pre>';
//        print_r($specs);
//        die;
        return view('pages.shoppingCart', [
            'cart' => $specs
        ]);
//        return view('pages.shoppingCart');
    }

    public function loginVerify()
    {
        if ($this->isFormSubmitted($_POST)) {
            $email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $login = new Login($email, $password);
            if ($login->validate() && $this->isAdminLoggedIn()) {
                return redirect('admin');
            } elseif ($login->validate() && !$this->isAdminLoggedIn()) {
                return redirect('view');
            } else {
                return redirect()->back()->with(
                    'loginError', true
                );
            }
        }
        return view('pages.index');
    }

    public function registerUser()
    {
        $sanitizedInputs = filter_input_array(INPUT_POST, $this->registerValidateFormInputs());
        $emptyArrayKeys = array_keys($sanitizedInputs, "");
        if (!empty($emptyArrayKeys)) {
            return redirect()->back()->with([
                'inputErrors' => $emptyArrayKeys
            ]);
        } else {
            $registerThis = new Register($sanitizedInputs['first_name'],
                $sanitizedInputs['last_name'],
                $sanitizedInputs['email'],
                $sanitizedInputs['password'],
                $sanitizedInputs['phone_number'],
                $sanitizedInputs['door_number'],
                $sanitizedInputs['street'],
                $_POST['appartment'],
                $sanitizedInputs['city'],
                $sanitizedInputs['province'],
                $sanitizedInputs['country'],
                $sanitizedInputs['postal_code']
            );
            $exists = $registerThis->isEmailExists();
            if ($exists) {
                return redirect()->back()->with(['emailExists' => true]);
            } else {
                $registerThis->createAccount();
            }
            return view('pages.login', ['registrationSuccess' => true]);
        }
    }

    public function clients()
    {
        return view('pages.clients', ['clients' => AccountMapper::getInstance()->getAllAccounts()]);
    }

    public function viewProfile() {
        $accountMapper = AccountMapper::getInstance();
        $currentUser = $accountMapper->getAccountFromRecordById($_SESSION['currentLoggedInId']);
        return view('pages.client-profile', ['currentUser' => $currentUser]);
    }

    public function deleteAccount(){
        if($this->isFormSubmitted($_POST)) {
            $userId = filter_input(INPUT_POST, 'current-user-id');
            $sessionMapper = new SessionMapper();
            $sessionMapper->closeSession($userId);
            $_SESSION = array();
            session_destroy();
            //Delete user
            $accountMapper = AccountMapper::getInstance();
            $accountMapper->deleteAccount($userId, $userId);
            $accountMapper->commit($userId);
            return view('pages.index', ['accountDeleted' => 'Your Account has been successfully deleted!']);
        } else {
            return view('pages.index', ['accountNotDeleted' => 'Something went wrong. Please try again later.']);
        }
    }
}

