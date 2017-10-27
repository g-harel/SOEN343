<?php

namespace App\Models;

class Laptop extends Computer
{
    private $displaySize;
    private $os;
    private $battery;
    private $camera;
    private $isTouchscreen;

    public function __construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $displaySize, $os, $battery, $camera, $isTouchscreen) {
        parent::__construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
        $this->displaySize = $displaySize;
        $this->os = $os;
        $this->battery = $battery;
        $this->camera = $camera;
        $this->isTouchscreen = $isTouchscreen;
    }

    public function getDisplaySize() {
        return $this->displaySize;
    }

    public function getOs() {
        return $this->os;
    }

    public function getBattery() {
        return $this->battery;
    }

    public function getCamera() {
        return $this->camera;
    }

    public function getIsTouchscreen() {
        return $this->isTouchscreen;
    }

    public function setDisplaySize($displaySize) {
        $this->displaySize = $displaySize;
    }

    public function setOs($os) {
        $this->os = $os;
    }

    public function setBattery($battery) {
        $this->battery = $battery;
    }

    public function setCamera($camera) {
        $this->camera = $camera;
    }

    public function setIsTouchscreen($isTouchscreen) {
        $this->isTouchscreen = $isTouchscreen;
    }
}