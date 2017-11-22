<?php

namespace App\Models;

/**
*   NOTE: THIS CLASS IS MADE TO BE INSTANCIATED ONLY WHEN A account HAS ALREADY BEEN REGISTERED AKA GOT INTO THE DATABASE.
*
*/
class Session
{
    private $accountId;
    private $id;
    private $loginTime;

    public function __construct($id, $accountId, $loginTime) {
        $this->accountId = $accountId;
        $this->id = $id;
        $this->loginTime = $loginTime;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function getId() {
        return $this->id;
    }

    public function getLoginTime() {
        return $this->loginTime;
    }

    public function setAccountId($accountId) {
        $this->accountId = $accountId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLoginTime($loginTime) {
        $this->loginTime = $loginTime;
    }

    public function equals($session): bool {
        return $this->id === $session->getId() &&
        $this->accountId === $session->getAccountId() &&
        $this->loginTime === $session->getLoginTime();
    }
}