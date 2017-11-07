<?php
namespace App\Http\Controllers;

use App\Mappers\SessionMapper;
use App\Mappers\UserMapper;

class Login {

    private $userMapper;
    private $sessionMapper;
    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->sessionMapper = new SessionMapper();
        $this->userMapper = new UserMapper();
        $this->email = $email;
        $this->password = $password;
    }

    public function validate()
    {
        if ($this->userMapper->isUserExist($this->email, $this->password)) {

            $_SESSION['isAdmin'] = $this->userMapper->setUserFromRecordByEmail($this->email)->getIsAdmin();
            $_SESSION['currentLoggedInId'] = $this->userMapper->setUserFromRecordByEmail($this->email)->getId();
            $userId = $this->userMapper->setUserFromRecordByEmail($this->email)->getId();
            $sessionMapper = new SessionMapper();
            $sessionMapper->openSession2($userId);
            return true;
        } else {
            return false;
        }
    }

}


?>