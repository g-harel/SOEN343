<?php

namespace App\Mappers;

use App\Models\Item;
use App\Gateway\ItemGateway;

class ItemMapper
{
    private $item;
    private $gateway;

//    public function __construct() {
//        $this->gateway = new ItemGateway();
//    }

    public static function createItemMapper($item) {
        $instance = new self();
        $instance->setItem($item);
        return $instance;
    }

    public static function createItemMapperDecomposed($category, $brand, $price, $quantity) {
        $item = Item::createWithAddressDecomposed($category, $brand, $price, $quantity);
        $instance = self::createItemMapper($item);
        return $instance;
    }

    //Getters
    public function getId() {
        return $this->item->getId();
    }

    public function getCategory() {
        return $this->item->getCategory();
    }

    public function getBrand() {
        return $this->item->getBrand();
    }

    public function getPrice() {
        return $this->item->getPrice();
    }

    public function getQuantity() {
        return $this->item->getQuantity();
    }

    //Setters
    public function setId($id) {
        return $this->item->setId($id);
    }

    public function setCategory($category) {
        return $this->item->setCategory($category);
    }

    public function setBrand($brand) {
        return $this->item->setBrand($brand);
    }

    public function setPrice($price) {
        return $this->item->setPrice($price);
    }

    public function setQuantity($quantity) {
        return $this->item->setQuantity($quantity);
    }
}