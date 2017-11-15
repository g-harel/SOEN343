<?php

namespace App\Models;

class Cart
{
    private $id;
    private $item1Id;
    private $item2Id;
    private $item3Id;
    private $item4Id;
    private $item5Id;
    private $item6Id;
    private $item7Id;

    public function __construct($id, $item1Id, $item2Id, $item3Id, $item4Id, $item5Id, $item6Id, $item7Id) {
        $this->id = $id;
        $this->item1Id = $item1Id;
        $this->item2Id = $item2Id;
        $this->item3Id = $item3Id;
        $this->item4Id = $item4Id;
        $this->item5Id = $item5Id;
        $this->item6Id = $item6Id;
        $this->item7Id = $item7Id;
    }

    public function getId() {
        return $this->id;
    }

    public function getItem1Id() {
        return $this->item1Id;
    }

    public function getItem2Id() {
        return $this->item1Id;
    }

    public function getItem3Id() {
        return $this->item1Id;
    }

    public function getItem4Id() {
        return $this->item1Id;
    }

    public function getItem5Id() {
        return $this->item1Id;
    }

    public function getItem6Id() {
        return $this->item1Id;
    }

    public function getItem7Id() {
        return $this->item1Id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setItem1Id($item1Id) {
        $this->item1Id = $item1Id;
    }

    public function setItem2Id($item2Id) {
        $this->item2Id = $item2Id;
    }

    public function setItem3Id($item3Id) {
        $this->item3Id = $item3Id;
    }

    public function setItem4Id($item4Id) {
        $this->item4Id = $item4Id;
    }

    public function setItem5Id($item5Id) {
        $this->item5Id = $item5Id;
    }

    public function setItem6Id($item6Id) {
        $this->item6Id = $item6Id;
    }

    public function setItem7Id($item7Id) {
        $this->item7Id = $item7Id;
    }
}