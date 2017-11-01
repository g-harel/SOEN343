<?php

<<<<<<< HEAD
use App\Mappers\AccountMapper;
use App\Models\Account;

class Register {

    private $accountMapper;
=======
use App\Mappers\UserMapper;
use App\Models\User;

class Register {

    private $userMapper;
>>>>>>> origin
    /*account info*/
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $is_Admin;
    private $phoneNumber;
    private $doorNumber;
    private $street;
    private $appt;
    private $city;
    private $province;
    private $country;
    private $postalCode;

    public function __construct($firstName,$lastName,$email,$password,$phoneNumber,$doorNumber,$street,$appt,$city,$province,$country,$postalCode) {
<<<<<<< HEAD
        $this->accountMapper = new AccountMapper();
        $newAccount = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
        $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin=false);
        $result = $this->accountMapper->setAccount($newAccount);
    }
    
    public function createAccount(){
        $result= $this->accountMapper->saveAccountInRecord();
=======
        $this->userMapper = new UserMapper();
        $newUser = User::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
        $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin=false);
        $result = $this->userMapper->setUser($newUser);
    }
    
    public function createUser(){
        $result= $this->userMapper->saveUserInRecord();
>>>>>>> origin
        return $result;
        
    } 
}
?>