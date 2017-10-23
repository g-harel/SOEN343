<?php

namespace App\Mappers;

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