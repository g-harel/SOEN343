<?php

class Item
{
    private $id;
    private $brand;
    private $price;
    private $quantity;

    public function __construct($id, $category, $brand, $price, $quantity) {
        $this->id = $id;
        $this->category = $category;
        $this->brand = $brand;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}

class Television extends Item
{
    private $height;
    private $width;
    private $thickness;
    private $weight;
    private $type;

    public function __construct($id, $category, $brand, $price, $quantity, $height, $width, $thickness, $weight, $type) {
        parent::__construct($id, $category, $brand, $price, $quantity);
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

class Monitor extends Item
{
    private $displaySize;
    private $weight;

    public function __construct($id, $category, $brand, $price, $quantity, $displaySize, $weight) {
        parent::__construct($id, $category, $brand, $price, $quantity);
        $this->displaySize = $displaySize;
        $this->weight = $weight;
    }

    public function getDisplaySize() {
        return $this->displaySize;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setDisplaySize($displaySize) {
        $this->displaySize = $displaySize;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }
}

class Computer extends Item
{
    private $processorType;
    private $ramSize;
    private $cpuCores;
    private $weight;
    private $type;

    public function __construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize) {
        parent::__construct($id, $category, $brand, $price, $quantity);
        $this->processorType = $processorType;
        $this->ramSize = $ramSize;
        $this->weight = $weight;
        $this->cpuCores = $cpuCores;
        $this->hddSize = $hddSize;
    }

    public function getProcessorType() {
        return $this->processorType;
    }

    public function getRamSize() {
        return $this->ramSize;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getCpuCores() {
        return $this->cpuCores;
    }

    public function getHddSize() {
        return $this->hddSize;
    }

    public function setProcessorType($processorType) {
        $this->processorType = $processorType;
    }

    public function setRamSize($ramSize) {
        $this->ramSize = $ramSize;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setCpuCores($cpuCores) {
        $this->cpuCores = $cpuCores;
    }

    public function setHddSize($hddSize) {
        $this->hddSize = $hddSize;
    }
}

class Desktop extends Computer
{
    private $height;
    private $width;
    private $thickness;

    public function __construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $height, $width, $thickness) {
        parent::__construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
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

class Laptop extends Computer
{
    private $displaySize;
    private $os;
    private $battery;
    private $camera;
    private $touchscreen;

    public function __construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $displaySize, $os, $battery, $camera, $touchscreen) {
        parent::__construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
        $this->displaySize = $displaySize;
        $this->os = $os;
        $this->battery = $battery;
        $this->camera = $camera;
        $this->touchscreen = $touchscreen;
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

    public function getTouchscreen() {
        return $this->touchscreen;
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

    public function setTouchscreen($touchscreen) {
        $this->touchscreen = $touchscreen;
    }
}

class Tablet extends Computer
{
    private $displaySize;
    private $width;
    private $height;
    private $thickness;
    private $battery;
    private $os;
    private $camera;
    private $touchscreen;

    public function __construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize, $displaySize, $width, $height, $thickness, $battery, $os, $camera, $touchscreen) {
        parent::__construct($id, $category, $brand, $price, $quantity, $processorType, $ramSize, $cpuCores, $weight, $hddSize);
        $this->displaySize = $displaySize;
        $this->width = $width;
        $this->height = $height;
        $this->thickness = $thickness;
        $this->battery = $battery;
        $this->os = $os;
        $this->camera = $camera;
        $this->touchscreen = $touchscreen;
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

    public function getTouchscreen() {
        return $this->touchscreen;
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

    public function setTouchscreen($touchscreen) {
        $this->touchscreen = $touchscreen;
    }
}
