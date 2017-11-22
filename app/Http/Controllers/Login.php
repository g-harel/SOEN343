<?php

namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\AccountMapper;

class Login
{
    private $sessionMapper;
    private $email;
    private $password;
    private $accountMapper;

    public function __construct($email, $password)
    {
        $this->sessionMapper = new SessionMapper();
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
            $sessionMapper = new SessionMapper();
            $sessionMapper->openSession2($accountId);
            // get the session id by the account
            $_SESSION['session_id'] = $sessionMapper->getSessionByAccountIdMapper($accountId)[0]['id'];
            return true;
        } else {
            return false;
        }
    }
}