<?php

namespace App\Models;

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