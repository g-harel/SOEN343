<?php

namespace App\Models;

class Television extends Item
{
    private $height;
    private $width;
    private $thickness;
    private $weight;
    private $type;

    public function __construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $height, $width, $thickness, $weight, $type) {
        parent::__construct($id, $model, $category, $brand, $price, $quantity, $isDeleted);
        $this->height = $height;
        $this->width = $width;
        $this->thickness = $thickness;
        $this->weight = $weight;
        $this->type = $type;
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

    public function getWeight() {
        return $this->weight;
    }

    public function getType() {
        return $this->type;
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

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
