<?php

namespace App\Mappers;

use App\Gateway\MonitorGateway;

class MonitorMapper extends ItemMapper{

    private $monitor;
    private $gateway;

    public function __construct()
    {
        $this->gateway = new MonitorGateway();
    }

    public function getMonitor()
    {
        return $this->monitor;
    }

    public function setMonitor($monitor)
    {
        $this->monitor = $monitor;
    }

    public function getAll()
    {
        return $this->gateway->getAll();
    }

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