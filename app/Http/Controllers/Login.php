<?php

namespace App\Http\Controllers;

use App\Mappers\SessionCatalogMapper;
use App\Mappers\AccountMapper;

class Login
{
    private $sessionMapper;
    private $email;
    private $password;
    private $accountMapper;

    public function __construct($email, $password)
    {
        $this->sessionMapper = SessionCatalogMapper::getInstance();
        $this->email = $email;
        $this->password = $password;
        $this->accountMapper = AccountMapper::getInstance();
    }

    public function validate()
    {
        if ($this->accountMapper->isAccountExist($this->email, $this->password)) {
            $_SESSION['isAdmin'] = $this->accountMapper->getAccountFromRecordByEmail($this->email)['isAdmin'];
            $_SESSION['currentLoggedInId'] = $this->accountMapper->getAccountFromRecordByEmail($this->email)['id'];
            $_SESSION['currentLoggedInEmail'] = $this->email;
            $accountId = $this->accountMapper->getAccountFromRecordByEmail($this->email)['id'];
            $this->sessionMapper->openSession($accountId);
            // get the session id by the account
            $_SESSION['session_id'] = $this->sessionMapper->getSession($accountId)['id'];
            return true;
        } else {
            return false;
        }
    }
}