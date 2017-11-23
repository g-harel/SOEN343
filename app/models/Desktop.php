<?php

namespace App\Models;

class Desktop extends Computer
{
    private $height;
    private $width;
    private $thickness;

    public function __construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $height, $width, $thickness) {
        parent::__construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
        $this->height = $height;
        $this->width = $width;
        $this->thickness = $thickness;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getThickness() {
        return $this->thickness;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setThickness($thickness) {
        $this->thickness = $thickness;
    }
}