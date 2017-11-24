<?php

namespace App\Models;


class SessionCatalog
{
    private $catalog;

    public function __construct() {
        $this->catalog = array();
    }

    public function removeSession($id): bool {
        $isWorkDone = false;
        foreach ($this->catalog as $session) {
            $idMatch = $session->getId() === $id;
            if ($idMatch) {
                $accountId = $session->getAccountId();
                unset($this->catalog[$accountId]);
                $isWorkDone = true;
                break;
            }
        }
        return $isWorkDone;
    }

    public function clearAccountSession($accountId): bool {
        $isWorkDone = false;
        if($this->hasSession($accountId)) {
            unset($this->catalog[$accountId]);
            $isWorkDone = true;
        }
        return $isWorkDone;
    }

    public function hasSession($accountId): bool {
        return array_key_exists($accountId, $this->catalog);
    }

    public function isAccountSessionValid($accountId, $sessionId): bool {
        $isValid = false;
        if ($this->hasSession($accountId)) {
            $isValid = $this->getSessionId($accountId) == $sessionId;
        }
        return $isValid;
    }

    public function isSessionValid($sessionId): bool {
        $isValid = false;
        foreach ($this->catalog as $session) {
            if ($session->getId() === $sessionId) {
                $isValid = true;
                break;
            }
        }
        return $isValid;
    }

    public function addSession($id, $accountId, $loginTime){
        $session = new Session($id, $accountId, $loginTime);
        $this->catalog[$accountId] = $session;

    }

    public function getSession($accountId) {
        if ($this->hasSession($accountId)) {
            return $this->catalog[$accountId];
        } else {
            return null;
        }
    }

    public function getSessionId($accountId): int {
        if ($this->hasSession($accountId)) {
            return $this->catalog[$accountId]->getId();
        } else {
            return null;
        }
    }

    public function equals($accountId, $session): bool {
        $sessionInCatalog = $this->getSession($accountId);
        $sessionExists = $sessionInCatalog !== null;
        $objectsAreEqual = false;
        if ($sessionExists) {
            $objectsAreEqual = $sessionInCatalog->equals($session);
        }
        return $objectsAreEqual;
    }

}