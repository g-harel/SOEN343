<?php

namespace App\UnitOfWork;
use App\UnitOfWork\UnitOfWorkPair;

class UnitOfWorkMap{

    private $map;

    public function __construct() {

    }

    public function getMapper($id) {
        return $this->get($id)->getMapper();
    }

    public function getPairs() {
        return $this->map;
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
        $this->map[$id] = $pair;
    }

    private function get($id) {
        return $this->map[$id];
    }

    public function delete($id) {
        $toReturn = $this->map[$id];
        $map[$id] = null;
        return $toReturn;
    }

    public function exists($id) {
        return $this->map[$id] !== null;
    }
}