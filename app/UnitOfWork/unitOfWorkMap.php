<?php

namespace App\UnitOfWork;

use App\Mappers;

class UnitOfWork{

    private $map;

    public function __construct() {

    }

    public function getMapper($id) {
        return $this->get($id)->getMapper();
    }

    public function getObject($id) {
        return $this->get($id)->getObject();
    }

    public function createPair($id, $mapper, $object) {
        $pair = new UnitOfWorkPair($mapper, $object);
        $this->set($id, $pair);
    }

    public function setMapper($id, $mapper) {
        $object = $this->getObject($id);
        $this->createPair($id, $mapper, $object);
    }

    public function setObject($id, $object) {
        $mapper = $this->getMapper($id);
        $this->createPair($id, $mapper, $object);
    }

    private function set($id, $pair) {
        $map[$id] = $pair;
    }

    private function get($id) {
        return $map[$id];
    }

    public function delete($id) {
        $toReturn = $map[$id];
        $map[$id] = null;
        return $toReturn;
    }

    public function exists($id) {
        return $map[$id] !== null;
    }




}