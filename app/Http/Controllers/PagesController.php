<?php

namespace App\Http\Controllers;

use App\Mappers\SessionCatalogMapper;
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
        $desktops = $this->returnItemUnits(Controller::DESKTOP_ITEM_TYPE);
        return view('pages.viewDesktop', [
            'desktops' => $desktops
        ]);
    }

    public function viewLaptop()
    {
        return view('pages.viewLaptop', [
            'laptops' => $this->returnItemUnits(Controller::LAPTOP_ITEM_TYPE)
        ]);
    }

    public function viewMonitor()
    {
        $monitors = $this->returnItemUnits(Controller::MONITOR_ITEM_TYPE);
        return view('pages.viewMonitor', [
            'monitors' => $monitors
        ]);
    }

    public function viewTablet()
    {
        $tablets = $this->returnItemUnits(Controller::TABLET_ITEM_TYPE);
        return view('pages.viewTablet', [
            'tablets' => $tablets
        ]);
    }

    public function monitorDetails($id, $serial)
    {
        $monitors = $this->returnItemUnits(Controller::MONITOR_ITEM_TYPE);
        $details = [];
        $monitor_ids = array_column($monitors, 'id');
        if(in_array((int)$id, $monitor_ids)) {
            foreach($monitors as $monitor){
                if($monitor['serial'] == $serial)
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

    public function desktopDetails($id, $serial)
    {
        $desktops = $this->returnItemUnits(Controller::DESKTOP_ITEM_TYPE);
        $details = [];
        $desktops_ids = array_column($desktops, 'id');
        if(in_array((int)$id, $desktops_ids)) {
            foreach($desktops as $desktop){
                if($desktop['serial'] == $serial)
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

    public function laptopDetails($id, $serial)
    {
        $laptops = $this->returnItemUnits(Controller::LAPTOP_ITEM_TYPE);
        $details = [];
        $laptops_ids = array_column($laptops, 'id');
        if(in_array((int)$id, $laptops_ids)) {
            foreach($laptops as $laptop){
                if($laptop['serial'] == $serial)
                    $details = $laptop;
            }
            return view('pages.viewLaptop', [
                'details' => $details,
            ]);
        } else {
            return redirect()->back()->with([
                'notFound' => true
            ]);
        }
    }

    public function tabletDetails($id, $serial)
    {
        $tablets = $this->returnItemUnits(Controller::TABLET_ITEM_TYPE);
        $details = [];
        $tablets_ids = array_column($tablets, 'id');
        if(in_array((int)$id, $tablets_ids)) {
            foreach($tablets as $tablet){
                if($tablet['serial'] == $serial)
                    $details = $tablet;
            }
            return view('pages.viewTablet', [
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
        if (isset($_SESSION['currentLoggedInId'])) {
            return view('pages.index');
        }
        return view('pages.login');
    }

    public function logout()
    {
        // on log out close session item in session table as well
        $sessionMapper = SessionCatalogMapper::getInstance();
        if (isset($_SESSION['currentLoggedInId'])) {
            $sessionMapper->closeSession($_SESSION['currentLoggedInId'], $_SESSION['session_id']);
            $sessionMapper->commit($_SESSION['session_id']);
        }
        $_SESSION = array();
        session_destroy();
        return redirect('/');
    }

    public function registerVerification()
    {
        return view('pages.registerVerification');
    }

    public function shoppingCart()
    {
        $total = 0;
        $specs = [];
        $finalSpecs = []; //specs with units values
        $cart = UnitMapper::getInstance();
        if (isset($_SESSION['currentLoggedInId'])) {
            $account_id = $_SESSION['currentLoggedInId'];
            $units = $cart->getCart($account_id); // returns reserved units by account id
            $itemMapper = ItemCatalogMapper::getInstance();
            foreach ($units as $unit) {
                $item_specs = $itemMapper->getItem($unit['item_id']); // returns specs given an item id
                array_push($specs, $item_specs);
            }
            foreach ($specs as $key => &$subArray) {
                $subArray += $units[$key];
                array_push($finalSpecs, $subArray);
            }
        }
        foreach($finalSpecs as $price){
            $total += $price['price'];
        }
        return view('pages.shoppingCart', [
            'cart' => $finalSpecs,
            'total' => $total
        ]);

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
            return redirect('/login');
        }
    }

    public function clients() {
        return view('pages.clients', ['clients' => AccountMapper::getInstance()->getAllAccounts()]);
    }

    public function viewProfile() {
        $accountMapper = AccountMapper::getInstance();
        $currentUser = $accountMapper->getAccountFromRecordByEmail($_SESSION['currentLoggedInEmail']);
        return view('pages.client-profile', ['currentUser' => $currentUser]);
    }

    public function deleteAccount() {
        if($this->isFormSubmitted($_POST)) {
            $userEmail = $_SESSION['currentLoggedInEmail'];
            $userId = filter_input(INPUT_POST, 'current-user-id');
            $sessionMapper = SessionCatalogMapper::getInstance();
            $sessionMapper->closeSession($userId, $_SESSION['session_id']);
            $_SESSION = array();
            session_destroy();
            //Delete user
            $accountMapper = AccountMapper::getInstance();
            $accountMapper->deleteAccount($userId, $userEmail);
            $accountMapper->commit($userId);
            return view('pages.index', ['accountDeleted' => 'Your Account has been successfully deleted!']);
        } else {
            return view('pages.index', ['accountNotDeleted' => 'Something went wrong. Please try again later.']);
        }
    }
}

