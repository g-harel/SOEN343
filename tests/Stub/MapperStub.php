<?php

namespace Tests\Stub;

use App\UnitOfWork\CollectionMapper;

class MapperStub implements CollectionMapper
{
    private $addArray;
    private $editArray;
    private $deleteArray;

    public function __construct() {
        $this->addArray = array();
        $this->editArray = array();
        $this->deleteArray = array();
    }

    public function getAddArray(){
        return $this->addArray;
    }

    public function getEditArray(){
        return $this->editArray;
    }

    public function getDeleteArray(){
        return $this->deleteArray;
    }

    public function add($object){
        $this->addArray[] = $object;
    }

    public function edit($object) {
        $this->editArray[] = $object;
    }

    public function delete($object) {
        $this->deleteArray[] = $object;
    }
}