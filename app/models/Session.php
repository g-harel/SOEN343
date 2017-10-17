<?php

namespace App\Models;

/**
*   NOTE: THIS CLASS IS MADE TO BE INSTANCIATED ONLY WHEN A USER HAS ALREADY BEEN REGISTERED AKA GOT INTO THE DATABASE.
*
*/
class Session
{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function getUserId() {
        return $this->user->getId();
    }

    public function getUserEmail() {
        return $this->user->getEmail();    
    }

    public function getUserPassword() {
        return $this->user->getPassword();
    }

    public function getUserFirstName() {
        return $this->user->getFirstName();
    }

    public function getUserLastName() {
        return $this->user->getLastName();
    }

    public function getUserPhoneNumber() {
        return $this->user->getPhoneNumber();
    }

    public function getUserAddress() {
        return $this->user->getAddress();
    }

    public function getUserIsAdmin() {
        return $this->user->getIsAdmin();
    }

    public function getUserDoorNumber() {
        return $this->user->getDoorNumber();    
    }

    public function getUserAppartement() {
        return $this->user->getAppartement();
    }

    public function getUserStreet() {
        return $this->user->getStreet();
    }

    public function getUserCity() {
        return $this->user->getCity();
    }

    public function getUserProvince() {
        return $this->user->getProvince();
    }

    public function getUserCountry() {
        return $this->user->getCountry();
    }

    public function getUserPostalCode() {
        return $this->user->getPostalCode();
    }

    public function setUserId($id) {
        $this->user->setId($id);
    }

    public function setUserEmail($email) {
        $this->user->setEmail($email);
        return $this; 
    }

    public function setUserPassword($password) {
        $this->user->setPassword($password);
        return $this;
    }

    public function setUserFirstName($firstName) {
        $this->user->setFirstName($firstName);
        return $this;
    }

    public function setUserLastName($lastName) {
        $this->user->setLastName($lastName);
        return $this;
    }

    public function setUserPhoneNumber($phoneNumber) {
        $this->user->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setUserAddress($address) {
        $this->user->setAddress($address);
        return $this;
    }

    public function setUserIsAdmin($isAdmin) {
        $this->user->setIsAdmin($isAdmin);
        return $this;
    }

    public function setUserDoorNumber($doorNumber) {
        $this->user->setDoorNumber($doorNumber); 
        return $this;   
    }

    public function setUserAppartement($appartement) {
        $this->user->setAppartement($appartement);
        return $this;
    }

    public function setUserStreet($street) {
        $this->user->setStreet($street);
        return $this;
    }

    public function setUserCity($city) {
        $this->user->setCity($city);
        return $this;
    }

    public function setUserProvince($province) {
        $this->user->setProvince($province);
        return $this;
    }

    public function setUserCountry($country) {
        $this->user->setCountry($country);
        return $this;
    }

    public function setUserPostalCode($postalCode) {
        $this->user->setPostalCode($postalCode);
        return $this;
    }

    public function getUserFullName() {
        return $this->user->getFullName();
    }
}