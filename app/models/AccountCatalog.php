<?php

namespace App\Models;

use SplObjectStorage;

class AccountCatalog
{
    private static $catalog;
    private static $instance;

    private function __construct()
    {
        self::$catalog = new SplObjectStorage();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new AccountCatalog();
        }
        return self::$instance;
    }

    public function addAccount($account)
    {
        self::$catalog->attach($account);
    }

    public function removeAccount($accountId)
    {
        self::$catalog->detach($this->getAccount($accountId));
    }

    public function isEmailExist($email)
    {
        $accounts = self::$catalog;
        foreach($accounts as $account)
        {
            if(($account->getEmail() == $email))
            {
                return true;
            }
        }
        return false;
    }

    public function getAccount($accountId)
    {
        $accounts = self::$catalog;
        foreach($accounts as $account)
        {
            if($account->getId() === (string)$accountId)
            {
                return $account;
            }
        }
        return null;
    }

    public function getCatalog()
    {
        return self::$catalog;
    }
}