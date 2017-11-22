<?php

namespace App\Mappers;

use App\Models\AccountCatalog;
use App\Gateway\AccountGateway;
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
        $identityMapId = $this->getAccountId($email);
        $isItemInIdentityMap = $this->identityMap->hasId($identityMapId);
        $account = null;
        if ($isItemInIdentityMap) {
            $account = $this->identityMap->getObject($identityMapId);
        } else {
            // If we fall into the else, this should be null. I put this here just in case. Don't want to break anything.
            $account = $this->accountCatalog->getAccountFromEmail($email);
        }
        if ($account === null) {
            return null;
        } else {
            return $account->toArray();
        }
    }

    private function getAccountId($email) {
        return $email . "account";
    }

    public function addAccount($transactionId, $accountParams)
    {
        $account = $this->accountCatalog->createAccount($accountParams);
        $this->unitOfWork->registerNew($transactionId, self::$instance, $account);
    }

    public function deleteAccount($transactionId, $email)
    {
        $account = $this->accountCatalog->getAccountFromEmail($email);
        $this->unitOfWork->registerDeleted($transactionId, $this->getAccountId($account->getEmail()), self::$instance, $account);
    }

    public function updateCatalog()
    {
        $accounts = $this->gateway->getAll();
        foreach ($accounts as $account)
            $this->accountCatalog->addAccount($this->accountCatalog->createAccount($this->databaseArrayToFormParams($account)));
    }

    private function databaseArrayToFormParams($dbParams)
    {
        $account = array();
        $account["id"] = $dbParams["id"];
        $account["email"] = $dbParams["email"];
        $account["password"] = $dbParams["password"];
        $account["firstName"] = $dbParams["first_name"];
        $account["lastName"] = $dbParams["last_name"];
        $account["phoneNumber"] = $dbParams["phone_number"];
        $account["doorNumber"] = $dbParams["door_number"];
        $account["appt"] = $dbParams["appartement"];
        $account["street"] = $dbParams["street"];
        $account["city"]= $dbParams["city"];
        $account["province"] = $dbParams["province"];
        $account["country"] = $dbParams["country"];
        $account["postalCode"] = $dbParams["postal_code"];
        $account["isAdmin"] = $dbParams["isAdmin"];
        return $account;
    }

    public function getAllAccounts()
    {
        return $this->accountCatalog->toArray();
    }

    public function isEmailExists($email)
    {
        if($this->getAccountFromRecordByEmail($email) != null)
            return true;
        return false;
    }

    public function isAccountExist($email, $password)
    {
        if($this->isEmailExists($email))
        {
            if($this->getAccountFromRecordByEmail($email)["password"] === $password)
                return true;
            return false;
        }
        return false;
    }

    //For UoW
    public function add($account)
    {
        $id = $this->gateway->addAccount(
            $account->getEmail(), $account->getPassword(), $account->getFirstName(), $account->getLastName(),
            $account->getPhoneNumber(), $account->getDoorNumber(), $account->getAppartement(),
            $account->getStreet(), $account->getCity(), $account->getProvince(), $account->getCountry(),
            $account->getPostalCode(), $account->getIsAdmin()
        );
        $identityMapId = $this->getAccountId($id);
        if ($this->identityMap->hasId($identityMapId)){
            return false;
        }
        $account->setId($id);
        $this->identityMap->set($identityMapId, $account);
        $this->accountCatalog->addAccount($account);
        return true;
    }

    //For UoW
    public function edit($object)
    {
        //Not needed
    }

    //For UoW
    public function delete($account)
    {
        $email = $account->getEmail();
        $identityMapId = $this->getAccountId($email);
        $deleted = $this->gateway->deleteAccountByEmail($email);
        if ($deleted) {
            $this->identityMap->removeObject($identityMapId);
            $this->accountCatalog->removeAccount($email);
        }
    }

    public function commit($transactionId)
    {
        $this->unitOfWork->commit($transactionId);
    }
}