<?php

namespace App\Mappers;

use App\Models\Item;
use App\Gateway\ItemGateway;

class ItemMapper
{
    private $item;
    private $gateway;

    public function __construct() {
        $this->gateway = new ItemGateway();
    }

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

class MonitorMapper extends ItemMapper{
    private $monitor;

    //Getters
    public function getDisplaySize() {
        return $this->monitor->getDisplaySize();
    }

    public function getWeight() {
        return $this->monitor->getWeight();
    }

    //Setters
    public function setDisplaySize($displaySize) {
        return $this->monitor->getDisplaySize($displaySize);
    }

    public function setWeight($weight) {
        return $this->monitor->setWeight($weight);
    }
}

class ComputerMapper extends ItemMapper{
    private $computer;

    //Getters
    public function getProcessorType() {
        return $this->computer->getProcessorType();
    }

    public function getRamSize() {
        return $this->computer->getRamSize();
    }

    public function getWeight() {
        return $this->computer->getWeight();
    }

    public function getCpuCores() {
        return $this->copmuter->getCpuCores();
    }

    public function getHddSize() {
        return $this->computer->getHddSize();
    }

    //Setters
    public function setProcessorType($processorType) {
        return $this->computer->setProcessorType($processorType);
    }

    public function setRamSize($ramSize) {
        return $this->computer->setRamSize($ramSize);
    }

    public function setWeight($weight) {
        return $this->computer->setWeight($weight);
    }

    public function setCpuCores($cpuCores) {
        return $this->computer->setCpuCores($cpuCores);
    }

    public function setHddSize($hddSize) {
        return $this->computer->setHddSize($hddSize);
    }
}

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

class LaptopMapper extends ItemMapper{
    private $laptop;

    //Getters
    public function getDisplaySize() {
        return $this->laptop->getDisplaySize();
    }

    public function getOs() {
        return $this->laptop->getOs();
    }

    public function getBattery() {
        return $this->laptop->getBattery();
    }

    public function getCamera() {
        return $this->laptop->getCamera();
    }

    public function getIsTouchscreen() {
        return $this->laptop->getIsTouchscreen();
    }

    //Setters
    public function setDisplaySize($displaySize) {
        return $this->laptop->setDisplaySize($displaySize);
    }

    public function setOs($os) {
        return $this->laptop->setOs($os);
    }

    public function setBattery($battery) {
        return $this->laptop->setBattery($battery);
    }

    public function setCamera($camera) {
        return $this->laptop->setCamera($camera);
    }

    public function setIsTouchscreen($isTouchscreen) {
        return $this->laptop->setIsTouchscreen($isTouchscreen);
    }

}

class TabletMapper extends ItemMapper{
    private $tablet;


    //Getters
    public function getDisplaySize() {
        return $this->tablet->getDisplaySize();
    }

    public function getWidth() {
        return $this->tablet->getWidth();
    }

    public function getHeight() {
        return $this->tablet->getHeight();
    }

    public function getThickness() {
        return $this->tablet->getThickness();
    }

    public function getBattery() {
        return $this->tablet->getBattery();
    }

    public function getOs() {
        return $this->tablet->getOs();
    }

    public function getCamera() {
        return $this->tablet->getCamera();
    }

    public function getTouchscreen() {
        return $this->tablet->getIsTouchscreen();
    }

    //Setters
    public function setDisplaySize($displaySize) {
        return $this->tablet->setDisplaySize($displaySize);
    }

    public function setWidth($width) {
        return $this->tablet->setWidth($width);
    }

    public function setHeight($height) {
        return $this->tablet->setHeight($height);
    }

    public function setThickness($thickness) {
        return $this->tablet->setThickness($thickness);
    }

    public function setBattery($battery) {
        return $this->tablet->setBattery($battery);
    }

    public function setOs($os){
        return $this->tablet->setOs($os);
    }

    public function setCamera($camera) {
        return $this->tablet->setCamera($camera);
    }

    public function setTouchscreen($isTouchscreen) {
        return $this->tablet->setIsTouchscreen($isTouchscreen);
    }



}
