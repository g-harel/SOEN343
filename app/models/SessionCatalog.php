<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-11-21
 * Time: 3:26 PM
 */

namespace App\Models;


class SessionCatalog
{
    private $catalog;

    public function __construct() {
        $this->catalog = array();
    }

    public function removeSession($accountId, $id): bool {
        $isWorkDone = false;
        if($this->isSessionValid($accountId, $id)) {
            unset($this->catalog[accountId]);
            $isWorkDone = true;
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

    public function isSessionValid($accountId, $sessionId): bool {
        $isValid = false;
        if ($this->hasSession($accountId)) {
            $isValid = $this->getSessionId($accountId) === $sessionId;
        }
        return $isValid;
    }

    public function addSession($id, $accountId, $loginTime): void {
        $session = new Session($id, $accountId, $loginTime);
        $catalog[$accountId] = $session;
    }

    public function getSession($accountId): Session {
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

}