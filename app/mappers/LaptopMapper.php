<?php

namespace App\Mappers;

use App\Gateway\LaptopGateway;

class LaptopMapper extends ItemMapper{

    private $laptop;
    private $gateway;

    public function __construct()
    {
        $this->gateway = new LaptopGateway();
    }

    public function getAll()
    {
        return $this->gateway->getAll();
    }

    //Getters
    public function getLaptop()
    {
        return $this->laptop;
    }

    public function getDisplaySize() {
        return $this->laptop->getDisplaySize();
    }

    public function getOs() {
        return $this->laptop->getOs();
    }

    public function getBattery() {
        return $this->laptop->getBattery();
    }

    public function getCamera() {
        return $this->laptop->getCamera();
    }

    public function getIsTouchscreen() {
        return $this->laptop->getIsTouchscreen();
    }

    //Setters
    public function setLaptop($laptop)
    {
        $this->laptop = $laptop;
    }

    public function setDisplaySize($displaySize) {
        return $this->laptop->setDisplaySize($displaySize);
    }

    public function setOs($os) {
        return $this->laptop->setOs($os);
    }

    public function setBattery($battery) {
        return $this->laptop->setBattery($battery);
    }

    public function setCamera($camera) {
        return $this->laptop->setCamera($camera);
    }

    public function setIsTouchscreen($isTouchscreen) {
        return $this->laptop->setIsTouchscreen($isTouchscreen);
    }

}