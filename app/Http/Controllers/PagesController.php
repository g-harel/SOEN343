<?php

namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\ItemCatalogMapper;

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

    public function viewDesktop()
    {
        return view('pages.viewDesktop', [
            'desktops' => ItemCatalogMapper::getInstance()->selectAllItemType(3)
        ]);
    }

    public function viewLaptop()
    {
        return view('pages.viewLaptop', [
            'laptops' => ItemCatalogMapper::getInstance()->selectAllItemType(4)
        ]);
    }

    public function viewMonitor()
    {
        return view('pages.viewMonitor', [
            'monitors' => ItemCatalogMapper::getInstance()->selectAllItemType(1)
        ]);
    }

    public function viewTablet()
    {
        return view('pages.viewTablet', [
            'tablets' => ItemCatalogMapper::getInstance()->selectAllItemType(5)
        ]);
    }

    public function monitorDetails($id)
    {
        $monitors = ItemCatalogMapper::getInstance()->selectAllItemType(1);
        $details = array();
        foreach ($monitors as $monitor) {
            if ($monitor['id'] == trim($id)) {
                $details = $monitor;
                break;
            }
            return view('pages.viewMonitor', [
                'notFound' => true,
                'for' => 'Monitor'
            ]);
        }
        return view('pages.viewMonitor', [
            'details' => $details,
        ]);
    }

    public function desktopDetails($id)
    {
        $desktops = ItemCatalogMapper::getInstance()->selectAllItemType(3);
        $details = array();
        foreach($desktops as $desktop){
            if($desktop['id'] == trim($id)){
                $details = $desktop;
                break;
            }
            return view('pages.viewDesktop', [
                'notFound' => true,
                'for' => 'Desktop'
            ]);
        }
        return view('pages.viewDesktop', [
            'details' => $details,
        ]);
    }

    public function laptopDetails($id)
    {
        $laptops = ItemCatalogMapper::getInstance()->selectAllItemType(4);
        $laptopItem = null;
        foreach ($laptops as $laptop) {
            if($laptop['id'] == trim($id)) {
                $laptopItem = $laptop;
                break;
            }
            return view('pages.viewLaptop', [
                'notFound' => true,
                'for' => 'Laptop'
            ]);
        }
        return view('pages.viewLaptop', [
            'laptopDetails' => $laptopItem
        ]);
    }

    public function tabletDetails($id)
    {
        $tablets = ItemCatalogMapper::getInstance()->selectAllItemType(5);
        $tabletItem = null;
        foreach ($tablets as $tablet) {
            if($tablet['id'] == trim($id)) {
                $tabletItem = $tablet;
                break;
            }
            return view('pages.viewTablet', [
                'notFound' => true,
                'for' => 'Tablet'
            ]);
        }
        return view('pages.viewTablet', [
            'tabletDetails' => $tabletItem
        ]);
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
                $registerThis->createUser();
            }
            return view('pages.view');
        }
    }
}

