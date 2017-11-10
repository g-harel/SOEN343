<?php

use App\Mappers\SessionMapper;
use App\Mappers\AccountMapper;

class Login{

    private $accountMapper;
    private $sessionMapper;
    private $email;
    private $password;

    public function __construct($email, $password) {

        $this->accountMapper = new AccountMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate()
	{ 
		$account = $this->accountMapper->setAccountFromRecordByEmail($this->email)->getAccount();
	
		if($account){;
            $password = $account->getPassword();
            $isAdmin = $account->getIsAdmin();
            if($password == $this->password){
                $this->sessionMapper = SessionMapper::openSession($account);
                return $isAdmin;
            }

            else{
                return -1;
            }
        }
        else{
            return -1;
        }

    }

    public function getSession(){
		$session = $this->sessionMapper->$openSession($account);
        return $session;
        
    }

    public function logout(){
        
        
    }
}


?>