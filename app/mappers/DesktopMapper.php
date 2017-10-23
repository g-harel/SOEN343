<?php

namespace App\Mappers;

class DesktopMapper extends ItemMapper{

    private $desktop;

    //Getters
    public function getHeight() {
        return $this->desktop->getHeight();
    }

    public function getWidth() {
        return $this->desktop->getWidth();
    }

    public function getThickness() {
        return $this->desktop->getThickness();
    }

    //Setters

    public function setHeight($height) {
        return $this->desktop->setHeight($height);
    }

    public function setWidth($width) {
        return $this->desktop->setWidth($width);
    }

    public function setThickness($thickness) {
        return $this->desktop->setThickness($thickness);
    }
}