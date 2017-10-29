<?php

namespace App\UnitOfWork;

use App\Mappers;

class UnitOfWork{

    const STATE_NEW = "NEW";
    const STATE_DIRTY = "DIRTY";
    const STATE_DELETED = "DELETED";

    const ACTION_INSERT = "INSERT";
    const ACTION_DELETE = "DELETEOBJECT";
    const ACTION_MODIFY = "MODIFY";

    private $unitOfWork;
    private $storage;

    private function __construct() {
        $this->storage[self::STATE_NEW] = array();
        $this->storage[self::STATE_DIRTY] = array();
        $this->storage[self::STATE_DELETED] = array();
    }

    public static function getInstance() {
        if ($this->unitOfWork == null) {
            $this->unitOfWork = new UnitOfWork();
        }
        return $this->unitOfWork;
    }

    private function registerEntity($transactionId, $mapper, $object, $state, $objectId = null) {
        
        /*
        DATA STRUCTURE FOR STORAGE
        storage = [
            "NEW": [
                transactionId: [
                    {mapper, object},
                    ...
                ],
            ],

            "DIRTY": [
                transactionId: (UNIT OF WORK MAP) [
                    objectId: {mapper, object},
                    objectId2: {mapper, object},
                    ...
                ],
            ],

            "DELETED": [
                transactionId: (UNIT OF WORK MAP) [
                    objectId: {mapper, object},
                    objectId2: {mapper, object},
                    ...
                ],
            ]
        ]
        */

        $stateStorage = $this->storage[$state];
        if ($stateStorage === null) {
            $stateStorage[$transactionId] = array($transactionId => array());
        }

        $transactions = $stateStorage[$transactionId];

        if ($state === self::STATE_NEW) {
            $transactions[] = new UnitOfWorkPair($mapper, $object);
        } else {
            if ($transactions === null) {
                $transactions = new UnitOfWorkMap();
            }
            $transactions->createPair($objectId, $mapper, $object);
        }
    }

    /**
     * Make sure that the same object isn't in both the DIRTY and DELETED state at the same time.
     */
    private function removeFromState($transactionId, $objectId, $state) {
        $stateStorage;
        if ($state === self::STATE_DIRTY) {
            $stateStorage = $this->storage[self::STATE_DELETED];
        } else if ($state === self::STATE_DELETED) {
            $stateStorage = $this->storage[self::STATE_DIRTY];
        } else {
            return;
        }

        $transactions;
        if ($transactionId !== null && $stateStorage[$transactionId] !== null) {
            $transactions = $stateStorage[$transactionId];
        } else {
            return;
        }

        if ($objectId !== null) {
            $transactions->delete($objectId);
        } else {
            return;
        }
    }

    public function registerNew($transactionId, $mapper, $object) {
        $state = self::STATE_NEW;
        $this->registerEntity($transactionId, $mapper, $object, $state);
    }

    public function registerDirty($transactionId, $objectId, $mapper, $object) {
        $state = self::STATE_DIRTY;
        $this->registerEntity($transactionId, $mapper, $object, $state, $objectId);
        $this->removeFromState($transactionId, $objectId, $state);
    }

    public function registerDeleted($transactionId, $objectId, $mapper, $object) {
        $state = self::STATE_DELETED;
        $this->registerEntity($transactionId, $mapper, $object, $state, $objectId);
        $this->removeFromState($transactionId, $objectId, $state);
    }

    private function mapperAction($actionToPerform, $mapper, $object) {
        if ($actionToPerform === self::ACTION_INSERT) {
            $mapper->add($object);
        } else if ($actionToPerform === self::ACTION_MODIFY) {
            $mapper->edit($object);
        } else if ($actionToPerform === self::ACTION_DELETEOBJECT) {
            $mapper->delete($object);
        }
    }

    public function commit($transactionId) {

        $actionToPerform;
        foreach ($this->storage as $key => $array) {
            if ($key === self::STATE_NEW) {
                $actionToPerform = self::ACTION_INSERT;
            } else if ($key === self::STATE_DIRTY) {
                $actionToPerform = self::ACTION_MODIFY;
            } else if ($key === self::STATE_DELETE) {
                $actionToPerform = self::ACTION_DELETEOBJECT;;
            }

            if (array_key_exists($array, $transactionId)){
                foreach($array[$transactionId] as $transaction) {
                    $transactionMapper = $transaction->getMapper();
                    $transactionObject = $transaction->getObject();
                    $this->mapperAction($actionToPerform, $transactionMapper, $transactionObject);
                }
            }
        }
        $this->clear($transactionId);
    }

    public function rollback($transactionId, $objectId) {
        foreach ($this->storage as $array) {
            if (array_key_exists($array, $transactionId)) {
                $array[$transactionId]->delete($objectId);
            }
        }
    }

    public function clear($transactionId) {
        foreach ($this->storage as $array) {
            if (array_key_exists($array, $transactionId)) {
                $array[$transactionId] = array();
            }
        }
    }





}