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

    public static function addAccount($account)
    {
        self::$catalog->attach($account);
    }

    public static function isEmailExist($email)
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


    public static function getCatalog()
    {
        return self::$catalog;
    }
}