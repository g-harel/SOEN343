<?php

namespace App\Http\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use Illuminate\Http\Request;
use App\Gateway\SessionGateway;
use App\Gateway\UserGateway;
use App\Mappers\SessionMapper;

class PagesController extends Controller
{
    public function index(){
        $gateway = new SessionGateway();
        $adminId = $isAdmin = null;
        if(isset($_SESSION['adminId']) && isset($_SESSION['isAdmin'])) {
            $adminId = $_SESSION['adminId'];
            $isAdmin = $_SESSION['isAdmin'];
        }
        $adminSession = $gateway->getSessionById($adminId);
        $adminSession['isAdmin'] = $isAdmin;
        return view('pages.index')->with('session', $adminSession);
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

    public function view(){
        return view('pages.view');
    }

    public function viewDesktop(){
        return view('pages.viewDesktop');
    }
    public function viewLaptop(){
        return view('pages.viewLaptop');
    }
    public function viewMonitor(){
        return view('pages.viewMonitor');
    }
    public function viewTablet(){
        return view('pages.viewTablet');
    }

    public function monitorDetails($id){
        return view('pages.viewMonitor')->with('id',$id);
    }

    public function desktopDetails($id){
        return view('pages.viewDesktop')->with('id',$id);
    }

    public function laptopDetails($id){
        return view('pages.viewLaptop')->with('id',$id);
    }

    public function tabletDetails($id){
        return view('pages.viewTablet')->with('id',$id);
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
  
    public function registerVerification(){
        return view('pages.registerVerification');
}

    public function shoppingCart(){
        return view('pages.shoppingCart');
    }

    public function loginVerifyAdmin() {
        // use gate way for now
        // validate if this admin exist
        if(!empty($_POST)) {
            $email = $_POST['username'];
            $password = $_POST['password'];
            $userGateway = new UserGateway();
            if($userGateway->getUserByEmail($email)) {
                $_SESSION['adminId'] = $userGateway->getUserByEmail($email)[0]['id'];
                $_SESSION['isAdmin'] = $userGateway->getUserByEmail($email)[0]['isAdmin'];
                echo $_SESSION['adminId'];

            } else {
                echo 'cannot access';
            }

        }
    }
}

