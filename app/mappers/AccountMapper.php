<?php

namespace App\Mappers;

use App\Models\Account;
use App\Models\AccountCatalog;
use App\Gateway\AccountGateway;
use App\Models\Address;
use App\UnitOfWork\CollectionMapper;
use App\IdentityMap\IdentityMap;
use App\UnitOfWork\UnitOfWork;


class AccountMapper implements CollectionMapper
{
    private $gateway;
    private $accountCatalog;
    private $identityMap;
    private $unitOfWork;
    private static $instance;

    private function __construct()
    {
        $this->gateway = new AccountGateway();
        $this->accountCatalog = AccountCatalog::getInstance();
        $this->identityMap = IdentityMap::getInstance();
        $this->unitOfWork = UnitOfWork::getInstance();
        $this->updateCatalog();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new AccountMapper();
        }
        return self::$instance;
    }

    public function getAccountFromRecordByEmail($email)
    {
        return $this->accountCatalog->getAccountFromEmail($email);
    }

    public function getAccountFromRecordById($accountId) {

        $identityMapId = $this->getAccountId($accountId);
        $isItemInIdentityMap = $this->identityMap->hasId($identityMapId);
        $account = null;
        if ($isItemInIdentityMap) {
            $account = $this->identityMap->getObject($identityMapId);
        } else {
            // If we fall into the else, this should be null. I put this here just in case. Don't want to break anything.
            $account = $this->accountCatalog->getAccount($accountId);
        }

        if ($account === null) {
            return null;
        } else {
            return $account;
        }
    }

    private function getAccountId($id) {
        return $id . "account";
    }

    public function addAccount($account)
    {
        $result = null;
        if(!($this->isEmailExists($account['email'])))
        {
            $result = $this->gateway->addAccount(
                $account['email'], $account['password'], $account['firstName'], $account['lastName'],
                $account['phoneNumber'], $account['doorNumber'], $account['appt'],
                $account['street'], $account['city'], $account['province'], $account['country'],
                $account['postalCode'], false
            );
        }
        $isSuccessful = false;
        if ($result !== null) {
            /*$id = $result[0]["id"];
            $this->account->setId($id);*/
            $isSuccessful = true;
        }
        return $isSuccessful;
    }

    public function deleteAccount($transactionId, $accountId)
    {
        $account = $this->accountCatalog->getAccount($accountId);
        $this->unitOfWork->registerDeleted($transactionId, $this->getAccountId($account->getId()), self::$instance, $account);
    }

    public function updateCatalog()
    {
        $accounts = $this->gateway->getAll();
        foreach ($accounts as $account)
        {
            $address = new Address($account["door_number"], $account["appartement"], $account["street"], $account["city"], $account["province"], $account["country"], $account["postal_code"]);
            $accountObject = new Account($account["email"], $account["password"], $account["first_name"], $account["last_name"], $account["phone_number"], $address, $account["isAdmin"]);
            $accountObject->setId($account["id"]);
            $this->accountCatalog->addAccount($accountObject);
        }
    }

    public function getAllAccounts()
    {
        return $this->accountCatalog->getCatalog();
    }

    public function isEmailExists($email)
    {
        return $this->accountCatalog->isEmailExist($email);
    }

    public function isAccountExist($email, $password)
    {
        return $this->accountCatalog->isAccountExist($email, $password);
    }

    //For UoW
    public function add($object)
    {
        //Not Needed
    }

    //For UoW
    public function edit($object)
    {
    }

    //For UoW
    public function delete($account)
    {
        $id = $account->getId();
        $identityMapId = $this->getAccountId($id);
        $deleted = $this->gateway->deleteAccountById($id);
        if ($deleted) {
            $this->identityMap->removeObject($identityMapId);
            $this->accountCatalog->removeAccount($id);
        }
    }

    public function commit($transactionId)
    {
        $this->unitOfWork->commit($transactionId);
    }
}