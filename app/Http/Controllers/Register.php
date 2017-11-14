<?php

namespace App\Http\Controllers;

use App\Mappers\AccountCatalogMapper;
use App\Models\Account;

class Register
{

    private $userMapper;
    /*account info*/
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $phoneNumber;
    private $doorNumber;
    private $street;
    private $appt;
    private $city;
    private $province;
    private $country;
    private $postalCode;

    public function __construct($firstName, $lastName, $email, $password,
                                $phoneNumber, $doorNumber, $street,
                                $appt, $city, $province, $country, $postalCode)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->phoneNumber = $phoneNumber;
        $this->doorNumber = $doorNumber;
        $this->street = $street;
        $this->appt = $appt;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->postalCode = $postalCode;

        $this->userMapper = new AccountCatalogMapper();
        $newUser = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin = false);
        $this->userMapper->setAccount($newUser);
    }

    public function createUser()
    {
        $result = $this->userMapper->saveAccountInRecord();
        return $result;

    }

    public function checkExistingEmail(){

        $email = $this->email;

        return $this->userMapper->getAccountByEmail($email) ;
    }
}
