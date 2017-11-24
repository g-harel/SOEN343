<?php

namespace App\Http\Controllers;

use App\Mappers\AccountCatalogMapper;

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
            'isAdmin' => false,
            'isDeleted' => false
        ];
        $this->accountMapper = AccountCatalogMapper::getInstance();
    }

    public function createAccount()
    {
        // -1 is a bogus session number used because when creating an account, there is no session yet.
        // -1 is used to not clash with other session number and to avoid wonky logic check that could happen with
        // sessionId = 0 (0 evaluates to false)
        $this->accountMapper->addAccount(-1, $this->params);
        $this->accountMapper->commit(-1);
    }

    public function isEmailExists()
    {
        return $this->accountMapper->isEmailExists($this->params['email']);
    }
}