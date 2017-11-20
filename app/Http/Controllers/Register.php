<?php

namespace App\Http\Controllers;

use App\Mappers\AccountMapper;

class Register
{
    private $accountMapper;
    private $params;

    public function __construct($firstName, $lastName, $email, $password,
                                $phoneNumber, $doorNumber, $street,
                                $appt, $city, $province, $country, $postalCode)
    {
        $this->params = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => $password,
            'phoneNumber' => $phoneNumber,
            'doorNumber' => $doorNumber,
            'street' => $street,
            'appt' => $appt,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'postalCode' => $postalCode,
            'isAdmin' => false
        ];
        $this->accountMapper = AccountMapper::getInstance();
    }

    public function createAccount()
    {
        $this->accountMapper->addAccount($this->params);
    }

    public function isEmailExists()
    {
        return $this->accountMapper->isEmailExists($this->params['email']);
    }
}