<?php

namespace App\Models;

/**
*   NOTE: THIS CLASS IS MADE TO BE INSTANCIATED ONLY WHEN A account HAS ALREADY BEEN REGISTERED AKA GOT INTO THE DATABASE.
*
*/
class Session
{
    private $account;

    public function __construct($account) {
        $this->account = $account;
    }

    public function getAccountId() {
        return $this->account->getId();
    }

    public function getAccountEmail() {
        return $this->account->getEmail();    
    }

    public function getAccountPassword() {
        return $this->account->getPassword();
    }

    public function getAccountFirstName() {
        return $this->account->getFirstName();
    }

    public function getAccountLastName() {
        return $this->account->getLastName();
    }

    public function getAccountPhoneNumber() {
        return $this->account->getPhoneNumber();
    }

    public function getAccountAddress() {
        return $this->account->getAddress();
    }

    public function getAccountIsAdmin() {
        return $this->account->getIsAdmin();
    }

    public function getAccountDoorNumber() {
        return $this->account->getDoorNumber();    
    }

    public function getAccountAppartement() {
        return $this->account->getAppartement();
    }

    public function getAccountStreet() {
        return $this->account->getStreet();
    }

    public function getAccountCity() {
        return $this->account->getCity();
    }

    public function getAccountProvince() {
        return $this->account->getProvince();
    }

    public function getAccountCountry() {
        return $this->account->getCountry();
    }

    public function getAccountPostalCode() {
        return $this->account->getPostalCode();
    }

    public function setAccountId($id) {
        $this->account->setId($id);
    }

    public function setAccountEmail($email) {
        $this->account->setEmail($email);
        return $this; 
    }

    public function setAccountPassword($password) {
        $this->account->setPassword($password);
        return $this;
    }

    public function setAccountFirstName($firstName) {
        $this->account->setFirstName($firstName);
        return $this;
    }

    public function setAccountLastName($lastName) {
        $this->account->setLastName($lastName);
        return $this;
    }

    public function setAccountPhoneNumber($phoneNumber) {
        $this->account->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setAccountAddress($address) {
        $this->account->setAddress($address);
        return $this;
    }

    public function setAccountIsAdmin($isAdmin) {
        $this->account->setIsAdmin($isAdmin);
        return $this;
    }

    public function setAccountDoorNumber($doorNumber) {
        $this->account->setDoorNumber($doorNumber); 
        return $this;   
    }

    public function setAccountAppartement($appartement) {
        $this->account->setAppartement($appartement);
        return $this;
    }

    public function setAccountStreet($street) {
        $this->account->setStreet($street);
        return $this;
    }

    public function setAccountCity($city) {
        $this->account->setCity($city);
        return $this;
    }

    public function setAccountProvince($province) {
        $this->account->setProvince($province);
        return $this;
    }

    public function setAccountCountry($country) {
        $this->account->setCountry($country);
        return $this;
    }

    public function setAccountPostalCode($postalCode) {
        $this->account->setPostalCode($postalCode);
        return $this;
    }

    public function getAccountFullName() {
        return $this->account->getFullName();
    }
}