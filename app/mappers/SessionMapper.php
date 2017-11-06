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

    public function closeSession()
    {
        $userId = $this->session->getUserId();
        $success = $this->gateway->deleteSessionByUserId($userId);
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