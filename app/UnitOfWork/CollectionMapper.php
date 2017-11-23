<?php

namespace App\UnitOfWork;

Interface CollectionMapper {
    public function add($object);
    public function edit($object);
    public function delete($object);
    public function commit($transactionId);
    public function registerDirty($transactionId, $objectId, CollectionMapper $mapper, $object);
    public function registerNew($transactionId, CollectionMapper $mapper, $object);
    public function registerDeleted($transactionId, $objectId, CollectionMapper $mapper, $object);
}
