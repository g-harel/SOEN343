<?php

namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\ItemCatalogMapper;

use App\Mappers\UnitMapper;
use App\Gateway\UnitGateway;

$ug = UnitGateway::getInstance();
$um = UnitMapper::getInstance();

function p($m, $serial) {
    $unit = $m->get($serial);
    echo "<div></div><pre>";
    if (!$unit) {
        echo "null";
    } else {
        echo json_encode(array(
            "serial" => $unit->getSerial(),
            "item_id" => $unit->getItemId(),
            "status" => $unit->getStatus(),
            "account_id" => $unit->getAccountId(),
            "reserved_date" => $unit->getReservedDate(),
            "purchased_price" => $unit->getPurchasedPrice(),
            "purchased_date" => $unit->getPurchasedDate(),
        ), JSON_PRETTY_PRINT);
    }
    echo "<br>";
    echo "</pre>";
}

$transactionId = 123456;
$serial = "SERIAL";
$accountId = 1;
$itemId = 1;
$purchasePrice = 2.99;

$um->remove($transactionId, $serial);
// $um->create($transactionId, $serial, $itemId);
// $um->reserve($transactionId, $serial, $accountId);
// $um->checkout($transactionId, $serial, $accountId, $purchasePrice);

p($um, $serial);

$um->commit($transactionId);

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

    public function view()
    {
        return view('pages.view');
    }

    public function viewProfile() {
        return view('pages.client-profile');
    }

    public function viewDesktop()
    {
        return view('pages.viewDesktop', [
            'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::DESKTOP_ITEM_TYPE)
        ]);
    }

    public function viewLaptop()
    {
        return view('pages.viewLaptop', [
            'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::LAPTOP_ITEM_TYPE)
        ]);
    }

    public function viewMonitor()
    {
        return view('pages.viewMonitor', [
            'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE)
        ]);
    }

    public function viewTablet()
    {
        return view('pages.viewTablet', [
            'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(Controller::TABLET_ITEM_TYPE)
        ]);
    }

    public function monitorDetails($id)
    {
        $details = [];
        if($this->isIdExistInCatalog($id, Controller::MONITOR_ITEM_TYPE)) {
            $monitors = ItemCatalogMapper::getInstance()->selectAllItemType(Controller::MONITOR_ITEM_TYPE);
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
        return view('pages.shoppingCart');
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
            return view('pages.register', [
                'inputErrors' => $emptyArrayKeys,
                'alertType' => 'warning'
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
            $exists = $registerThis->checkExistingEmail();
            if ($exists) {
                return redirect()->back()->with(['emailExists' => true]);
            } else {
                $registerThis->createAccount();
            }
            return view('pages.view');
        }
    }
}

