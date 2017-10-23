<?php

namespace App\Mappers;

class TabletMapper extends ItemMapper{

    private $tablet;

    //Getters
    public function getDisplaySize() {
        return $this->tablet->getDisplaySize();
    }

    public function getWidth() {
        return $this->tablet->getWidth();
    }

    public function getHeight() {
        return $this->tablet->getHeight();
    }

    public function getThickness() {
        return $this->tablet->getThickness();
    }

    public function getBattery() {
        return $this->tablet->getBattery();
    }

    public function getOs() {
        return $this->tablet->getOs();
    }

    public function getCamera() {
        return $this->tablet->getCamera();
    }

    public function getTouchscreen() {
        return $this->tablet->getIsTouchscreen();
    }

    //Setters
    public function setDisplaySize($displaySize) {
        return $this->tablet->setDisplaySize($displaySize);
    }

    public function setWidth($width) {
        return $this->tablet->setWidth($width);
    }

    public function setHeight($height) {
        return $this->tablet->setHeight($height);
    }

    public function setThickness($thickness) {
        return $this->tablet->setThickness($thickness);
    }

    public function setBattery($battery) {
        return $this->tablet->setBattery($battery);
    }

    public function setOs($os){
        return $this->tablet->setOs($os);
    }

    public function setCamera($camera) {
        return $this->tablet->setCamera($camera);
    }

    public function setTouchscreen($isTouchscreen) {
        return $this->tablet->setIsTouchscreen($isTouchscreen);
    }

}