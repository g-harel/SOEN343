<?php

namespace App\Mappers;

use App\Models\Session;
use App\Gateway\SessionGateway;


class SessionMapper
{
    private $session;
    private $gateway;
    private $userMapper;

    public function __construct()
    {
        $this->gateway = new SessionGateway();
    }

    private static function createSessionMapper($user)
    {
        $instance = new self();
        $session = new Session($user);
        $instance->setSession($session);
        $instance->setUserMapper($user);
        return $instance;
    }

    public static function openSession($user)
    {
        $instance = self::createSessionMapper($user);
        $userId = $instance->session->getUserId();
        $openedSession = $instance->gateway->getSessionByUserId($userId);
        if ($openedSession != null) {
            $instance->closeSession();
        }
        $instance->gateway->addSession($userId);
        return $instance;
    }
    //takes in the Id of the user currently logged in
    public function openSession2($userId) {
        if($this->gateway->addSession($userId)) {
            return '1';
        } else {
            return '0';
        }
    }

    public function closeSession($userId)
    {
        $success = $this->gateway->deleteSessionByAccountId($userId);
        return $success;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getUser()
    {
        return $this->session->getUser();
    }

    public function getUserMapper()
    {
        return $this->userMapper;
    }

    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }

    public function setUserMapper($userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }
}