<?php


use App\Mappers\AccountMapper;
use App\Models\Account;

class Register {

    private $accountMapper;
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
        $this->accountMapper = new AccountMapper();
        $newAccount = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
        $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin=false);
        $result = $this->accountMapper->setAccount($newAccount);
    }
    
    public function createAccount(){
        $result= $this->accountMapper->saveAccountInRecord();
        return $result;
    } 
}
?>