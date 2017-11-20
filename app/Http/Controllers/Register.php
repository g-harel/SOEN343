<?php

namespace App\Http\Controllers;

use App\Mappers\AccountMapper;
use App\Models\Account;

class Register
{
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
    private $account;

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

        $this->account = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appt, $street, $city, $province, $country, $postalCode, $is_Admin = false);
    }

    public function createAccount()
    {
        AccountMapper::getInstance()->addAccount($this->account);
    }

    public function isEmailExists()
    {
        return AccountMapper::getInstance()->isEmailExists($this->email);
    }
}