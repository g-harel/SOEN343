<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\IdentityMap\IdentityMap;
use Tests\Stub\ObjectStub;


class IdentityMapTest extends TestCase {

    public function testIdentityMapId() {
        $map = IdentityMap::getInstance();
        $objectId = 452;
        $object = new ObjectStub($objectId);

        $map->set($objectId, $object);

        $hasId = $map->hasId($objectId);
        $idIsTheSame = $map->getId($object) === $objectId;

        $this->assertTrue($hasId && $idIsTheSame);
    }

    public function testIdentityMapObject() {
        $map = IdentityMap::getInstance();
        $objectId = 452;
        $object = new ObjectStub($objectId);

        $map->set($objectId, $object);

        $hasId = $map->hasObject($object);
        $recoveredObject = $map->getObject($objectId);
        $this->assertTrue($hasId);
        $this->assertSame($object, $recoveredObject);
    }

    public function testRemoveIdentityMapObject() {
        $map = IdentityMap::getInstance();
        $objectId = 452;
        $object = new ObjectStub($objectId);

        $map->set($objectId, $object);

        $hadId = $map->hasObject($object);
        $map->removeObject($objectId);
        $isObjectRemoved = $map->hasId($objectId) === false;
        $this->assertTrue($hadId && $isObjectRemoved);

    }

}
