<?php

namespace App\Mappers;

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