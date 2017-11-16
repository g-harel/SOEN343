<?php

namespace App\Mappers;

use App\Models\Session;
use App\Gateway\SessionGateway;


class SessionMapper
{
    private $session;
    private $gateway;
    //private $accountMapper;

    public function __construct()
    {
        $this->gateway = new SessionGateway();
    }

    private static function createSessionMapper($account)
    {
//        $instance = new self();
////      $session = new Session($account);
//        $instance->setSession($session);
//        $instance->setAccountMapper($account);
//        return $instance;
    }

//    public static function openSession($account)
//    {
//        $instance = self::createSessionMapper($account);
//        $accountId = $instance->session->getAccountId();
//        $openedSession = $instance->gateway->getSessionByAccountId($accountId);
//        if ($openedSession != null) {
//            $instance->closeSession();
//        }
//        $instance->gateway->addSession($accountId);
//        return $instance;
//    }

    //takes in the Id of the Account currently logged in
    public function openSession2($accountId) {
        // add this admin/client to the session table
        if($this->gateway->addSession($accountId)) {
            return '1';
        } else {
            return '0';
        }
    }

    public function getSessionByAccountIdMapper($accountId) {
        return $this->gateway->getSessionByAccountId($accountId);
    }

    public function closeSession($accountId)
    {
        $success = $this->gateway->deleteSessionByAccountId($accountId);
        return $success;
    }

    public function getSession()
    {
        return $this->session;
    }

//    public function getAccount()
//    {
//        return $this->session->getAccount();
//    }

//    public function getAccountMapper()
//    {
//        return $this->AccountMapper;
//    }

//    public function setSession($session)
//    {
//        $this->session = $session;
//        return $this;
//    }

//    public function setAccountMapper($accountMapper)
//    {
//        $this->AccountMapper = $accountMapper;
//        return $this;
//    }
}