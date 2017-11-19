<?php

namespace App\Mappers;

use App\Models\Account;
use App\UnitOfWork\UnitOfWork;
use App\UnitOfWork\CollectionMapper;
use App\IdentityMap\IdentityMap;
use App\Gateway\AccountGateway;


class AccountMapper implements CollectionMapper
{
    private static $instance;
    private $itemCatalog;
    private $unitOfWork;
    private $identityMap;
    private $gateway;

    private function __construct() {
        $this->itemCatalog = ItemCatalog::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
        $this->gateway = new AccountGateway();
        $this->updateCatalog();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new ItemAccountMapper();
        }
        return self::$instance;
    }

    public static function createAccountMapperDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
                                                      $doorNumber, $appartement, $street, $city, $province,
                                                      $country, $postalCode, $isAdmin = false)
    {
        $account = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin);
        $instance = self::createAccountMapper($account);
        return $instance;
    }

    public function setAccountFromRecordByEmail($email) {
        $record = $this->gateway->getAccountByEmail($email);
        if ($record != null || $record != false) {
            $recordAccount = $record[0];
            $id = $recordAccount["id"];
            $email = $recordAccount["email"];
            $password = $recordAccount["password"];
            $firstName = $recordAccount["first_name"];
            $lastName = $recordAccount["last_name"];
            $phoneNumber = $recordAccount["phone_number"];
            $doorNumber = $recordAccount["door_number"];
            $appartement = $recordAccount["appartement"];
            $street = $recordAccount["street"];
            $city = $recordAccount["city"];
            $province = $recordAccount["province"];
            $country = $recordAccount["country"];
            $postalCode = $recordAccount["postal_code"];
            $isAdmin = $recordAccount["isAdmin"];
    
            $account = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin)->setId($id);
            $this->account = $account;
        }

        return $this;
    }
    
    public function setAccountFromRecordById($id) {
        $record = $this->gateway->getAccountById($id);
        if ($record != null || $record != false) {
            $recordAccount = $record[0];
            $id = $recordAccount["id"];
            $email = $recordAccount["email"];
            $password = $recordAccount["password"];
            $firstName = $recordAccount["first_name"];
            $lastName = $recordAccount["last_name"];
            $phoneNumber = $recordAccount["phone_number"];
            $doorNumber = $recordAccount["door_number"];
            $appartement = $recordAccount["appartement"];
            $street = $recordAccount["street"];
            $city = $recordAccount["city"];
            $province = $recordAccount["province"];
            $country = $recordAccount["country"];
            $postalCode = $recordAccount["postal_code"];
            $isAdmin = $recordAccount["isAdmin"];
    
            $account = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin)->setId($id);
            $this->account = $account;
        }

        return $this;
    }

    public function saveAccountInRecord() {
        $result = $this->gateway->addAccount(
            $this->account->getEmail(), $this->account->getPassword(), $this->account->getFirstName(), $this->account->getLastName(),
            $this->account->getPhoneNumber(), $this->account->getDoorNumber(), $this->account->getAppartement(),
            $this->account->getStreet(), $this->account->getCity(), $this->account->getProvince(), $this->account->getCountry(),
            $this->account->getPostalCode(), $this->account->getIsAdmin()
        );
        $isSuccessful = false;
        if ($result !== null) {
            /*$id = $result[0]["id"];
            $this->account->setId($id);*/
            $isSuccessful = true;
        }
        return $isSuccessful;
    }
    
    public function deleteAccountInRecord() {
        $success = $this->gateway->deleteAccountById($this->account->getId());
        return $success;
    } 

    public function getAccount() {
        return $this->account;
    }

    public function getAccountByEmail($email) {
        return $this->gateway->getAccountByEmail($email);
    }
    
    public function getAccountById($id) {
        return $this->gateway->getAccountById($id);
    }

    //UTILITY
    public function getFullName() {
        return $this->account->getFullName();
    }

    public function isAccountExist($email, $password) {
        return $this->gateway->getAccountByEmailPassword($email, $password);
    }


    /* For Controllers */
    public function add($object)
    {
        //Not needed
    }

    public function edit($object)
    {
        //Not needed
    }

    public function delete($object)
    {
        // TODO: Implement delete() method.
    }
}