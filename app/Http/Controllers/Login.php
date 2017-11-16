<?php
namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\AccountMapper;

class Login {

    private $accountMapper;
    private $sessionMapper;
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->sessionMapper = new SessionMapper();
        $this->accountMapper = new AccountMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate()
    {
        if ($this->accountMapper->isAccountExist($this->email, $this->password)) {
            $_SESSION['isAdmin'] = $this->accountMapper->setAccountFromRecordByEmail($this->email)->getIsAdmin();
            $_SESSION['currentLoggedInId'] = $this->accountMapper->setAccountFromRecordByEmail($this->email)->getId();
            $_SESSION['fistName'] = $this->accountMapper->setAccountFromRecordByEmail($this->email)->getFirstName();
            $accountId = $this->accountMapper->setAccountFromRecordByEmail($this->email)->getId();
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


?>