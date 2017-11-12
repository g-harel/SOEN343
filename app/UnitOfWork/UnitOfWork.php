<?php

namespace App\UnitOfWork;
use App\UnitOfWork\UnitOfWorkPair;

class UnitOfWork{

    const STATE_NEW = "NEW";
    const STATE_DIRTY = "DIRTY";
    const STATE_DELETED = "DELETED";

    const ACTION_INSERT = "INSERT";
    const ACTION_DELETE = "DELETEOBJECT";
    const ACTION_MODIFY = "MODIFY";

    private static $unitOfWork;
    private $storage;

    private function __construct() {
        $this->storage[self::STATE_NEW] = array();
        $this->storage[self::STATE_DIRTY] = array();
        $this->storage[self::STATE_DELETED] = array();
    }

    public static function getInstance() {
        if (self::$unitOfWork === null) {
            self::$unitOfWork = new UnitOfWork();
        }
        return self::$unitOfWork;
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

        $sessionId = "0" . $transactionId;

        $stateStorage = $this->storage[$state];
        if ($stateStorage === null || empty($stateStorage) || !isset($stateStorage[$sessionId])) {
            $stateStorage[$sessionId] = array();
        }

        $transactions = $stateStorage[$sessionId];

        if ($state === self::STATE_NEW) {
            $transactions[] = new UnitOfWorkPair($mapper, $object);
        } else {
            if ($transactions === null || empty($transactions)) {
                $transactions = new UnitOfWorkMap();
            }
            $transactions->createPair($objectId, $mapper, $object);
        }

        $stateStorage[$sessionId] = $transactions;
        $this->storage[$state] = $stateStorage;
    }


    // Make sure that the same object isn't in both the DIRTY and DELETED state at the same time.
    private function removeFromState($transactionId, $objectId, $state) {
        $sessionId = "0" . $transactionId;
        $stateStorage = null;
        if ($state === self::STATE_DIRTY) {
            $stateStorage = $this->storage[self::STATE_DELETED];
        } else if ($state === self::STATE_DELETED) {
            $stateStorage = $this->storage[self::STATE_DIRTY];
        } else {
            return;
        }

        $transactions = null;
        if ($sessionId !== "0" && isset($stateStorage[$sessionId])) {
            $transactions = $stateStorage[$sessionId];
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
        } else if ($actionToPerform === self::ACTION_DELETE) {
            $mapper->delete($object);
        }
    }

    public function commit($transactionId, $objectId = null) {
        $sessionId = "0" . $transactionId;
        $actionToPerform = null;
        foreach ($this->storage as $key => $array) {
            if ($key === self::STATE_NEW) {
                $actionToPerform = self::ACTION_INSERT;
            } else if ($key === self::STATE_DIRTY) {
                $actionToPerform = self::ACTION_MODIFY;
            } else if ($key === self::STATE_DELETED) {
                $actionToPerform = self::ACTION_DELETE;
            }

            if (array_key_exists($sessionId, $array)){
                $iterate = null;
                if ($key === self::STATE_NEW) {
                    $iterate = $array[$sessionId];
                } else {
                    $iterate = $array[$sessionId]->getPairs();
                }
                foreach($iterate as $transaction) {
                        $transactionMapper = $transaction->getMapper();
                        $transactionObject = $transaction->getObject();
                        $this->mapperAction($actionToPerform, $transactionMapper, $transactionObject);
                    }
            }
        }
        $this->clear($sessionId);
    }

    public function rollback($transactionId, $objectId) {
        foreach ($this->storage as $array) {
            if (array_key_exists($transactionId, $array)) {
                $array[$transactionId]->delete($objectId);
            }
        }
    }

    public function clear($transactionId) {
        foreach ($this->storage as $array) {
            if (array_key_exists($transactionId, $array)) {
                $array[$transactionId] = array();
            }
        }
    }
}