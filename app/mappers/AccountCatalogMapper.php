<?php

namespace App\Mappers;

use App\Models\Account;
use App\Models\AccountCatalog;
use App\Gateway\AccountGateway;
use App\Models\Address;


class AccountCatalogMapper
{
    private $user;
    private $gateway;
    private $accountCatalog;

    public function __construct()
    {
        $this->gateway = new AccountGateway();
        $this->accountCatalog = AccountCatalog::getInstance();
        $this->updateCatalog();
    }

    public static function createUserMapper($user)
    {
        $instance = new self();
        $instance->setUser($user);
        return $instance;
    }

    public static function createUserMapperDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
                                                      $doorNumber, $appartement, $street, $city, $province,
                                                      $country, $postalCode, $isAdmin = false)
    {
        $user = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin);
        $instance = self::createUserMapper($user);
        return $instance;
    }

    public function setUserFromRecordByEmail($email)
    {
        $record = $this->gateway->getAccountByEmail($email);
        if ($record != null || $record != false) {
            $recordUser = $record[0];
            $id = $recordUser["id"];
            $email = $recordUser["email"];
            $password = $recordUser["password"];
            $firstName = $recordUser["first_name"];
            $lastName = $recordUser["last_name"];
            $phoneNumber = $recordUser["phone_number"];
            $doorNumber = $recordUser["door_number"];
            $appartement = $recordUser["appartement"];
            $street = $recordUser["street"];
            $city = $recordUser["city"];
            $province = $recordUser["province"];
            $country = $recordUser["country"];
            $postalCode = $recordUser["postal_code"];
            $isAdmin = $recordUser["isAdmin"];

            $user = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
                $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin)->setId($id);
            $this->user = $user;
        }

        return $this;
    }

    public function saveAccountInRecord()
    {
        $result = $this->gateway->addAccount(
            $this->user->getEmail(), $this->user->getPassword(), $this->user->getFirstName(), $this->user->getLastName(),
            $this->user->getPhoneNumber(), $this->user->getDoorNumber(), $this->user->getAppartement(),
            $this->user->getStreet(), $this->user->getCity(), $this->user->getProvince(), $this->user->getCountry(),
            $this->user->getPostalCode(), $this->user->getIsAdmin()
        );
        $isSuccessful = false;
        if ($result !== null) {
            /*$id = $result[0]["id"];
            $this->user->setId($id);*/
            $isSuccessful = true;
        }
        return $isSuccessful;
    }

    public function editAccountInRecord()
    {
        $success = $this->gateway->editAccount(
            $this->user->getId(), $this->user->getEmail(), $this->user->getPassword(), $this->user->getFirstName(), $this->user->getLastName(),
            $this->user->getPhoneNumber(), $this->user->getDoorNumber(), $this->user->getAppartement(),
            $this->user->getStreet(), $this->user->getCity(), $this->user->getProvince(), $this->user->getCountry(),
            $this->user->getPostalCode(), $this->user->getIsAdmin()
        );
        return $success;
    }

    public function deleteAccountInRecord()
    {
        $success = $this->gateway->deleteAccountByEmail($this->user->getEmail());
        return $success;
    }

    public function updateCatalog()
    {
        $accounts = $this->gateway->getAll();
        foreach ($accounts as $account)
        {
            $address = new Address($account->door_number, $account->appartement, $account->street, $account->city, $account->province, $account->country, $account->postal_code);
            $accountObject = new Account($account->email, $account->password, $account->first_name, $account->last_name, $account->phone_number, $address, $account->isAdmin);
            $accountObject->setId($account->id);
            AccountCatalog::addAccount($accountObject);
        }
    }

    public function getAllAccounts()
    {
        return AccountCatalog::getCatalog();
    }

    public function getAccount()
    {
        return $this->user;
    }

    public function getAccountByEmail($email)
    {
        return $this->gateway->getAccountByEmail($email);
    }

    public function getId()
    {
        return $this->user->getId();
    }

    public function getEmail()
    {
        return $this->user->getEmail();
    }

    public function getPassword()
    {
        return $this->user->getPassword();
    }

    public function getFirstName()
    {
        return $this->user->getFirstName();
    }

    public function getLastName()
    {
        return $this->user->getLastName();
    }

    public function getPhoneNumber()
    {
        return $this->user->getPhoneNumber();
    }

    public function getAddress()
    {
        return $this->user->getAddress();
    }

    public function getIsAdmin()
    {
        return $this->user->getIsAdmin();
    }

    public function getDoorNumber()
    {
        return $this->user->getDoorNumber();
    }

    public function getAppartement()
    {
        return $this->user->getAppartement();
    }

    public function getStreet()
    {
        return $this->user->getStreet();
    }

    public function getCity()
    {
        return $this->user->getCity();
    }

    public function getProvince()
    {
        return $this->user->getProvince();
    }

    public function getCountry()
    {
        return $this->user->getCountry();
    }

    public function getPostalCode()
    {
        return $this->user->getPostalCode();
    }

    public function setAccount($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setId($id)
    {
        $this->user->setId($id);
        return $this;
    }

    public function setEmail($email)
    {
        $this->user->setEmail($email);
        return $this;
    }

    public function setPassword($password)
    {
        $this->user->setPassword($password);
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this->user->setFirstName($firstName);
        return $this;
    }

    public function setLastName($lastName)
    {
        $this->user->setLastName($lastName);
        return $this;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->user->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setAddress($address)
    {
        $this->user->setAddress($address);
        return $this;
    }

    public function setDoorNumber($doorNumber)
    {
        $this->user->setDoorNumber($doorNumber);
        return $this;
    }

    public function setAppartement($appartement)
    {
        $this->user->setAppartement($appartement);
        return $this;
    }

    public function setStreet($street)
    {
        $this->user->setStreet($street);
        return $this;
    }

    public function setCity($city)
    {
        $this->user->setCity($city);
        return $this;
    }

    public function setProvince($province)
    {
        $this->user->setProvince($province);
        return $this;
    }

    public function setCountry($country)
    {
        $this->user->setCountry($country);
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->user->setPostalCode($postalCode);
        return $this;
    }

    //UTILITY
    public function getFullName()
    {
        return $this->user->getFullName();
    }

    public function isAccountExist($email, $password)
    {
        return $this->gateway->getAccountByEmailPassword($email, $password);
    }
}