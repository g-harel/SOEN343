<?php

namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\AccountMapper;

class Login
{

    private $sessionMapper;
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->sessionMapper = new SessionMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate()
    {
        if (AccountMapper::getInstance()->isAccountExist($this->email, $this->password)) {
            $_SESSION['isAdmin'] = AccountMapper::getInstance()->getAccountFromRecordByEmail($this->email)->getIsAdmin();
            $_SESSION['currentLoggedInId'] = AccountMapper::getInstance()->getAccountFromRecordByEmail($this->email)->getId();
            $accountId = AccountMapper::getInstance()->getAccountFromRecordByEmail($this->email)->getId();
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