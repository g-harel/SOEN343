<?php

namespace App\Models;

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
}

