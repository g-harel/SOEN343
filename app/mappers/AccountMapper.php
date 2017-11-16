<?php

namespace App\Mappers;

use App\Models\Account;
use App\Gateway\AccountGateway;


class AccountMapper
{
    private $account;
    private $gateway;

    public function __construct() {
        $this->gateway = new AccountGateway();
    }

    public static function createAccountMapper($account) {
        $instance = new self();
        $instance->setAccount($account);
        return $instance;
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

    public function editAccountInRecord() {
        $success = $this->gateway->editAccount(
            $this->account->getId(), $this->account->getEmail(), $this->account->getPassword(), $this->account->getFirstName(), $this->account->getLastName(),
            $this->account->getPhoneNumber(), $this->account->getDoorNumber(), $this->account->getAppartement(),
            $this->account->getStreet(), $this->account->getCity(), $this->account->getProvince(), $this->account->getCountry(),
            $this->account->getPostalCode(), $this->account->getIsAdmin()
        );
        return $success;
    }

    /*public function deleteAccountInRecord() {
        $success = $this->gateway->deleteAccountByEmail($this->account->getEmail());
        return $success;
    }*/
    
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

    public function getId() {
        return $this->account->getId();
    }

    public function getEmail() {
        return $this->account->getEmail();    
    }

    public function getPassword() {
        return $this->account->getPassword();
    }

    public function getFirstName() {
        return $this->account->getFirstName();
    }

    public function getLastName() {
        return $this->account->getLastName();
    }

    public function getPhoneNumber() {
        return $this->account->getPhoneNumber();
    }

    public function getAddress() {
        return $this->account->getAddress();
    }

    public function getIsAdmin() {
        return $this->account->getIsAdmin();
    }

    public function getDoorNumber() {
        return $this->account->getDoorNumber();    
    }

    public function getAppartement() {
        return $this->account->getAppartement();
    }

    public function getStreet() {
        return $this->account->getStreet();
    }

    public function getCity() {
        return $this->account->getCity();
    }

    public function getProvince() {
        return $this->account->getProvince();
    }

    public function getCountry() {
        return $this->account->getCountry();
    }

    public function getPostalCode() {
        return $this->account->getPostalCode();
    }

    public function setAccount($account) {
        $this->account = $account;
        return $this;
    }

    public function setId($id) {
        $this->account->setId($id);
        return $this;
    }

    public function setEmail($email) {
        $this->account->setEmail($email);
        return $this;  
    }

    public function setPassword($password) {
        $this->account->setPassword($password);
        return $this;
    }

    public function setFirstName($firstName) {
        $this->account->setFirstName($firstName);
        return $this;
    }

    public function setLastName($lastName) {
        $this->account->setLastName($lastName);
        return $this;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->account->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setAddress($address) {
        $this->account->setAddress($address);
        return $this;
    }

    public function setDoorNumber($doorNumber) {
        $this->account->setDoorNumber($doorNumber);
        return $this; 
    }

    public function setAppartement($appartement) {
        $this->account->setAppartement($appartement);
        return $this;
    }

    public function setStreet($street) {
        $this->account->setStreet($street);
        return $this;
    }

    public function setCity($city) {
        $this->account->setCity($city);
        return $this;
    }

    public function setProvince($province) {
        $this->account->setProvince($province);
        return $this;
    }

    public function setCountry($country) {
        $this->account->setCountry($country);
        return $this;
    }

    public function setPostalCode($postalCode) {
        $this->account->setPostalCode($postalCode);
        return $this;
    }

    //UTILITY
    public function getFullName() {
        return $this->account->getFullName();
    }

    public function isAccountExist($email, $password) {
        return $this->gateway->getAccountByEmailPassword($email, $password);
    }
}