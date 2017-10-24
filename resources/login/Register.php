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

        //option 1
        /*$this->userMapper = new UserMapper();
        $this->email = $email;
        $this->password = $password;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->email=$email;
        $this->password=$password;
        $this->phoneNumber=$phoneNumber;
        $this->doorNumber=$doorNumber;
        $this->street=$street;
        $this->appt=$appt;
        $this->city=$city;
        $this->province=$province;
        $this->country=$country;
        $this->postalCode=$postalCode;
        $this->is_Admin=false;*/
        
        //option 2
        $this->userMapper = new UserMapper();
        $newUser = User::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin=false);
        $result = $this->userMapper->setUser($newUser);
        
    }
    
    public function createUser(){
        
        /*option 1
        $this->userMapper->setEmail($this->email);
        $this->userMapper->setPassword($this->password);
        $this->userMapper->setFirstName($this->firstName);
        $this->userMapper->setLastName($this->lastName);
        $this->userMapper->setPhoneNumber($this->phoneNumber);
        $this->userMapper->setDoorNumber($this->doorNumber);
        $this->userMapper->setAppartement($this->appt);
        $this->userMapper->setStreet($this->street);
        $this->userMapper->setCity($this->city);
        $this->userMapper->setProvince($this->province);
        $this->userMapper->setPostalCode($this->postalCode);*/
        
        //option 2
       /* $this->userMapper = new UserMapper();
        $this->userMapper->user = User.createUserMapperDecomposed();*/
        
        //final 
        $result= $this->userMapper->saveUserInRecord();
        return $result;
        
    }

    
}


?>