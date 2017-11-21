<?php

namespace App\UnitOfWork;

Interface CollectionMapper {
    public function add($object);
    public function edit($object);
    public function delete($object);
    public function commit($transactionId);
    private function registerDirty($transactionId, $objectId, CollectionMapper $mapper, $object);
    private function registerNew($transactionId, CollectionMapper $mapper, $object);
    private function registerDeleted($transactionId, $objectId, CollectionMapper $mapper, $object);
}
