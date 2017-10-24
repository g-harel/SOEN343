<?php

namespace App\Mappers;

use App\Gateway\DesktopGateway;

class DesktopMapper extends ItemMapper{

    private $desktop;
    private $gateway;

    public function __construct()
    {
        $this->gateway = new DesktopGateway();
    }

    public function getDesktop()
    {
        return $this->desktop;
    }

    public function setDesktop($desktop)
    {
        $this->desktop = $desktop;
    }

    public function getAllDesktops()
    {
        return $this->gateway->getAllDesktops();
    }

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