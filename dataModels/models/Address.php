<?php
class Address
{
    private $id;
    private $doorNumber;
    private $appartement;
    private $street;
    private $city;
    private $province;
    private $country;
    private $postalCode;

    public function __construct($doorNumber, $appartement, $street, $city, $province, $country, $postalCode) {
        $this->doorNumber = $doorNumber;
        $this->appartement = $appartement;
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->postalCode = $postalCode;
    }

    public function getId() {
        return $this->id;
    }

    public function getDoorNumber() {
        return $this->doorNumber;    
    }

    public function getAppartement() {
        return $this->appartement;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getCity() {
        return $this->city;
    }

    public function getProvince() {
        return $this->province;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }



    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDoorNumber($doorNumber) {
        $this->doorNumber = $doorNumber;
        return $this;
    }

    public function setAppartement($appartement) {
        $this->appartement = $appartement;
        return $this;
    }

    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setProvince($province) {
        $this->province = $province;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }
}