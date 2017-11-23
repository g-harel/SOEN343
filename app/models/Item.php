<?php

namespace App\Models;

class Item
{
    private $id;
    private $model;
    private $brand;
    private $price;
    private $quantity;
    private $category;
    private $isDeleted;

    public function __construct($id, $model, $category, $brand, $price, $quantity, $isDeleted = 0) {
        $this->id = $id;
        $this->model = $model;
        $this->category = $category;
        $this->brand = $brand;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->isDeleted = $isDeleted;
    }

    public function getId() {
        return $this->id;
    }

    public function getModel() {
        return $this->model;
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

    public function getIsDeleted() {
        return $this->isDeleted;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setModel($model) {
        $this->model = $model;
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

    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;
    }
}
