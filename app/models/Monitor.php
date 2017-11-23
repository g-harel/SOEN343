<?php

namespace App\Models;

class Monitor extends Item
{
    private $displaySize;
    private $weight;

    public function __construct($id, $model, $category, $brand, $price, $quantity, $isDeleted, $displaySize, $weight) {
        parent::__construct($id, $model, $category, $brand, $price, $quantity, $isDeleted);
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