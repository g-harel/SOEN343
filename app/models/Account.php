<?php

namespace App\Models;

class Account
{
    private $id;
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $address;
    private $isAdmin;
    private $isDeleted;

    public function __construct($email, $password, $firstName, $lastName, $phoneNumber, $address, $isAdmin = false, $isDeleted = false) {
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->isAdmin = $isAdmin;
        $this->isDeleted = $isDeleted;
    }

    public static function createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber, $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin = false, $isDeleted = false) {
        $address = new Address($doorNumber, $appartement, $street, $city, $province, $country, $postalCode);
        $instance = new self($email, $password, $firstName, $lastName, $phoneNumber, $address, $isAdmin, $isDeleted);
        return $instance;
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function getIsDeleted() {
        return $this->isDeleted;
    }

    // FORWARDING GETTERS TO ADDRESS
    public function getDoorNumber() {
        return $this->address->getDoorNumber();
    }

    public function getAppartement() {
        return $this->address->getAppartement();
    }

    public function getStreet() {
        return $this->address->getStreet();
    }

    public function getCity() {
        return $this->address->getCity();
    }

    public function getProvince() {
        return $this->address->getProvince();
    }

    public function getCountry() {
        return $this->address->getCountry();
    }

    public function getPostalCode() {
        return $this->address->getPostalCode();
    }


    // SETTERS
    public function setId($id) {
        $this->id = $id;
        if ($this->address != null) {
            $this->address->setId($id);
        }
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    // FORWARDING SETTERS TO ADDRESS
    public function setDoorNumber($doorNumber) {
        $this->address->setDoorNumber($doorNumber);
        return $this;
    }

    public function setAppartement($appartement) {
        $this->address->setAppartement($appartement);
        return $this;
    }

    public function setStreet($street) {
        $this->address->setStreet($street);
        return $this;
    }

    public function setCity($city) {
        $this->address->setCity($city);
        return $this;
    }

    public function setProvince($province) {
        $this->address->setProvince($province);
        return $this;
    }

    public function setCountry($country) {
        $this->address->setCountry($country);
        return $this;
    }

    public function setPostalCode($postalCode) {
        $this->address->setPostalCode($postalCode);
        return $this;
    }

    //UTILITY
    public function getFullName() {
        return $this->firstName . " " . $this->lastName;
    }

    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'phoneNumber' => $this->getPhoneNumber(),
            'doorNumber' => $this->getDoorNumber(),
            'appartement' => $this->getAppartement(),
            'street' => $this->getStreet(),
            'city' => $this->getCity(),
            'province' => $this->getProvince(),
            'country' => $this->getCountry(),
            'postalCode' => $this->getPostalCode(),
            'isAdmin' => $this->getIsAdmin(),
            'isDeleted' => $this->getIsDeleted()
        );
    }
}