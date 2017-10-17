<?php

namespace App\Mappers;

use App\Models\User;
use App\Gateway\UserGateway;


class UserMapper
{
    private $user;
    private $gateway;

    public function __construct() {
        $this->gateway = new UserGateway();
    }

    public static function createUserMapper($user) {
        $instance = new self();
        $instance->setUser($user);
        return $instance;
    }

    public static function createUserMapperDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin = false) {
        $user = User::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
        $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin);
        $instance = self::createUserMapper($user);
        return $instance;
    }

    public function setUserFromRecordByEmail($email) {
        $record = $this->gateway->getUserByEmail($email);
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
    
            $user = User::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
            $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin)->setId($id);
            $this->user = $user;
        }

        return $this;
    }

    public function saveUserInRecord() {
        $success = $this->gateway->addUser(
            $this->user->getEmail(), $this->user->getPassword(), $this->user->getFirstName(), $this->user->getLastName(),
            $this->user->getPhoneNumber(), $this->user->getDoorNumber(), $this->user->getAppartement(),
            $this->user->getStreet(), $this->user->getCity(), $this->user->getProvince(), $this->user->getCountry(),
            $this->user->getPostalCode(), $this->user->getIsAdmin()
        );
        $recordUser = $this->gateway->getUserByEmail($this->user->getEmail());
        $id = $recordUser[0]["id"];
        $this->user->setId($id);
        return $success;
    }

    public function editUserInRecord() {
        $success = $this->gateway->editUser(
            $this->user->getId(), $this->user->getEmail(), $this->user->getPassword(), $this->user->getFirstName(), $this->user->getLastName(),
            $this->user->getPhoneNumber(), $this->user->getDoorNumber(), $this->user->getAppartement(),
            $this->user->getStreet(), $this->user->getCity(), $this->user->getProvince(), $this->user->getCountry(),
            $this->user->getPostalCode(), $this->user->getIsAdmin()
        );
        return $success;
    }

    public function deleteUserInRecord() {
        $success = $this->gateway->deleteUserByEmail($this->user->getEmail());
        return $success;
    }

    public function getUser() {
        return $this->user;
    }

    public function getId() {
        return $this->user->getId();
    }

    public function getEmail() {
        return $this->user->getEmail();    
    }

    public function getPassword() {
        return $this->user->getPassword();
    }

    public function getFirstName() {
        return $this->user->getFirstName();
    }

    public function getLastName() {
        return $this->user->getLastName();
    }

    public function getPhoneNumber() {
        return $this->user->getPhoneNumber();
    }

    public function getAddress() {
        return $this->user->getAddress();
    }

    public function getIsAdmin() {
        return $this->user->getIsAdmin();
    }

    public function getDoorNumber() {
        return $this->user->getDoorNumber();    
    }

    public function getAppartement() {
        return $this->user->getAppartement();
    }

    public function getStreet() {
        return $this->user->getStreet();
    }

    public function getCity() {
        return $this->user->getCity();
    }

    public function getProvince() {
        return $this->user->getProvince();
    }

    public function getCountry() {
        return $this->user->getCountry();
    }

    public function getPostalCode() {
        return $this->user->getPostalCode();
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function setId($id) {
        $this->user->setId($id);
        return $this;
    }

    public function setEmail($email) {
        $this->user->setEmail($email);
        return $this;  
    }

    public function setPassword($password) {
        $this->user->setPassword($password);
        return $this;
    }

    public function setFirstName($firstName) {
        $this->user->setFirstName($firstName);
        return $this;
    }

    public function setLastName($lastName) {
        $this->user->setLastName($lastName);
        return $this;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->user->setPhoneNumber($phoneNumber);
        return $this;
    }

    public function setAddress($address) {
        $this->user->setAddress($address);
        return $this;
    }

    public function setDoorNumber($doorNumber) {
        $this->user->setDoorNumber($doorNumber);
        return $this; 
    }

    public function setAppartement($appartement) {
        $this->user->setAppartement($appartement);
        return $this;
    }

    public function setStreet($street) {
        $this->user->setStreet($street);
        return $this;
    }

    public function setCity($city) {
        $this->user->setCity($city);
        return $this;
    }

    public function setProvince($province) {
        $this->user->setProvince($province);
        return $this;
    }

    public function setCountry($country) {
        $this->user->setCountry($country);
        return $this;
    }

    public function setPostalCode($postalCode) {
        $this->user->setPostalCode($postalCode);
        return $this;
    }

    //UTILITY
    public function getFullName() {
        return $this->user->getFullName();
    }
}