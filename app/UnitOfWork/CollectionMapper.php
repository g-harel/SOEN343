<?php

namespace App\UnitOfWork;

Interface CollectionMapper {
    public function add($object);
    public function edit($object);
    public function delete($object);
}
