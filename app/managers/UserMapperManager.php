<?php

use App\Mappers\SessionMapper;
use App\Mappers\UserMapper;

class UserMapperManager {

    private $userMappers = [];

    public static function addUserMapper($email, $userMapper)
	{ 
        if(!array_key_exists($email, $this->userMappers))
            $this->userMappers[$email] = $userMapper;
    }

    public static function removeUserMapper($email)
    {
        if(array_key_exists($email, $this->userMappers))
		    unset($this->userMappers[$email]);
    }

    public static function getUserMapper($email)
    {
        if(array_key_exists($email, $this->userMappers))
            return $this->userMappers[$email];
        
        return null;
    }

    public static function getUsers()
    {
        $users = [];

        foreach ($this->userMappers as $key => $value)
        {
            array_push($users, $key);
        }

        return $users;
    }
}


?>