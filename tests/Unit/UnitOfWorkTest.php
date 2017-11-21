<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\UnitOfWork\UnitOfWork;
use Tests\Stub\ObjectStub;
use Tests\Stub\MapperStub;

class UnitOfWorkTest extends TestCase {

    public function testRegisterNew() {
        $objectId1 = 54;
        $objectId2 = 11;
        $mapperStub = new MapperStub();
        $object1 = new ObjectStub($objectId1);
        $object2 = new ObjectStub($objectId2);
        $transactionId = 85;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerNew($transactionId, $mapperStub, $object1);
        $unitOfWork->registerNew($transactionId, $mapperStub, $object2);
        $unitOfWork->commit($transactionId);
        $outputArray = $mapperStub->getAddArray();
        $outputObject1 = $outputArray[0];
        $outputObject2 = $outputArray[1];
        $this->assertTrue($outputObject1->getId() === $objectId1);
        $this->assertTrue($outputObject2->getId() === $objectId2);
    }

    public function testRegisterDirty() {
        $objectId1 = 54;
        $objectId2 = 11;
        $mapperStub = new MapperStub();
        $object1 = new ObjectStub($objectId1);
        $object2 = new ObjectStub($objectId2);
        $transactionId = 85;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerDirty($transactionId, $objectId1, $mapperStub, $object1);
        $unitOfWork->registerDirty($transactionId, $objectId2, $mapperStub, $object2);
        $unitOfWork->commit($transactionId);
        $outputArray = $mapperStub->getEditArray();
        $outputObject1 = $outputArray[0];
        $outputObject2 = $outputArray[1];
        $this->assertTrue($outputObject1->getId() === $objectId1);
        $this->assertTrue($outputObject2->getId() === $objectId2);
    }

    public function testRegisterDeleted() {
        $objectId1 = 54;
        $objectId2 = 11;
        $mapperStub = new MapperStub();
        $object1 = new ObjectStub($objectId1);
        $object2 = new ObjectStub($objectId2);
        $transactionId = 85;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerDeleted($transactionId, $objectId1, $mapperStub, $object1);
        $unitOfWork->registerDeleted($transactionId, $objectId2, $mapperStub, $object2);
        $unitOfWork->commit($transactionId);
        $outputArray = $mapperStub->getDeleteArray();
        $outputObject1 = $outputArray[0];
        $outputObject2 = $outputArray[1];
        $this->assertTrue($outputObject1->getId() === $objectId1);
        $this->assertTrue($outputObject2->getId() === $objectId2);
    }

    public function testCommitAffectsOnlyOneSession() {
        $objectId1 = 54;
        $objectId2 = 11;
        $mapperStub = new MapperStub();
        $object1 = new ObjectStub($objectId1);
        $object2 = new ObjectStub($objectId2);
        $transactionId1 = 85;
        $transactionId2 = 44;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerDeleted($transactionId1, $objectId1, $mapperStub, $object1);
        $unitOfWork->registerDeleted($transactionId2, $objectId2, $mapperStub, $object2);
        $unitOfWork->commit($transactionId1);
        $outputArray = $mapperStub->getDeleteArray();
        $outputObject1 = $outputArray[0];
        $this->assertTrue(count($outputArray) === 1);
        $this->assertTrue($outputObject1->getId() === $objectId1);
    }

    public function testCommitAffectsNewDirtyAndDeleted() {
        $newId = 54;
        $dirtyId = 11;
        $deletedId = 231;
        $mapperStub = new MapperStub();
        $new = new ObjectStub($newId);
        $dirty = new ObjectStub($dirtyId);
        $deleted = new ObjectStub($deletedId);
        $transactionId = 85;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerNew($transactionId, $mapperStub, $new);
        $unitOfWork->registerDirty($transactionId, $dirtyId, $mapperStub, $dirty);
        $unitOfWork->registerDeleted($transactionId, $deletedId, $mapperStub, $deleted);
        $unitOfWork->commit($transactionId);
        $newArray = $mapperStub->getAddArray();
        $dirtyArray = $mapperStub->getEditArray();
        $deletedArray = $mapperStub->getDeleteArray();
        $newObject = $newArray[0];
        $dirtyObject = $dirtyArray[0];
        $deletedObject = $deletedArray[0];
        $arraysLengthOne = count($newArray) === 1 && count($dirtyArray) === 1 && count($deletedArray) === 1;
        $objectsHaveExpectedId = $newObject->getId() === $newId && $dirtyObject->getId() === $dirtyId &&
            $deletedObject->getId() === $deletedId;
        $this->assertTrue($arraysLengthOne && $objectsHaveExpectedId);
    }

    // Tests that an object that is first deleted then modified doesn't appear in the "to delete" pool.
    public function testSameObjectDeletedThenModified() {
        $objectId = 54;
        $mapperStub = new MapperStub();
        $object = new ObjectStub($objectId);
        $transactionId = 44;

        $unitOfWork = UnitOfWork::getInstance();

        $unitOfWork->registerDeleted($transactionId, $objectId, $mapperStub, $object);
        $unitOfWork->registerDirty($transactionId, $objectId, $mapperStub, $object);
        $unitOfWork->commit($transactionId);
        $deleteArray = $mapperStub->getDeleteArray();
        $dirtyArray = $mapperStub->getEditArray();
        $arrayHaveExpectedSize = count($dirtyArray) === 1 && count($deleteArray === 0);
        $outputObject = $dirtyArray[0];
        $outputMatchId = $outputObject->getId() === $objectId;
        $this->assertTrue($arrayHaveExpectedSize && $outputMatchId);
    }

}
