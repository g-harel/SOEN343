<?php

use App\Mappers\UserMapper;
use App\Models\User;

class Register{

    private $userMapper;
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
        $this->userMapper = new UserMapper();
        $newUser = User::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin=false);
        $result = $this->userMapper->setUser($newUser);
        
    }
    
    public function createUser(){
        $result= $this->userMapper->saveUserInRecord();
        return $result;
        
    }
    
}


?>