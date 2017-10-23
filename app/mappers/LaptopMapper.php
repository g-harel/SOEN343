<?php

namespace App\Mappers;

class LaptopMapper extends ItemMapper{

    private $laptop;

    //Getters
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