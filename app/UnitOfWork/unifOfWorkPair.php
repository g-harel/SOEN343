<?php

namespace App\UnitOfWork;

use App\Mappers;

class UnitOfWork{

    private $mapper;
    private $object;

    public function __construct($mapper, $object) {
        $this->mapper = $mapper;
        $this->object = $object;
    }

    public function getMapper() {
        return $this->mapper;
    }

    public function getObject() {
        return $this->object;
    }

    public function setMapper($mapper) {
        $this->mapper = $mapper;
    }

    public function setObject($object) {
        $this->object = $object;
    }
}