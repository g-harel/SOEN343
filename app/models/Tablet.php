<?php

namespace App\Models;

class Tablet extends Computer
{
    private $displaySize;
    private $width;
    private $height;
    private $thickness;
    private $battery;
    private $os;
    private $camera;
    private $isTouchscreen;

    public function __construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $displaySize, $width, $height, $thickness, $battery, $os, $camera, $touchscreen) {
        parent::__construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
        $this->displaySize = $displaySize;
        $this->width = $width;
        $this->height = $height;
        $this->thickness = $thickness;
        $this->battery = $battery;
        $this->os = $os;
        $this->camera = $camera;
        $this->isTouchscreen = $touchscreen;
    }

    public function getDisplaySize() {
        return $this->displaySize;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getThickness() {
        return $this->thickness;
    }

    public function getBattery() {
        return $this->battery;
    }

    public function getOs() {
        return $this->os;
    }

    public function getCamera() {
        return $this->camera;
    }

    public function setDisplaySize($displaySize) {
        $this->displaySize = $displaySize;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setThickness($thickness) {
        $this->thickness = $thickness;
    }

    public function setBattery($battery) {
        $this->battery = $battery;
    }

    public function setOs($os) {
        $this->os = $os;
    }

    public function setCamera($camera) {
        $this->camera = $camera;
    }

    public function getisTouchscreen()
    {
        return $this->isTouchscreen;
    }

    public function setIsTouchscreen($isTouchscreen)
    {
        $this->isTouchscreen = $isTouchscreen;
    }
}
