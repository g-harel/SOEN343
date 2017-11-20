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

    public function addAccount($transactionId, $accountParams)
    {
        $account = Account::createWithAddressDecomposed(
            $accountParams['email'], $accountParams['password'], $accountParams['firstName'], $accountParams['lastName'],
            $accountParams['phoneNumber'], $accountParams['doorNumber'], $accountParams['appt'],
            $accountParams['street'], $accountParams['city'], $accountParams['province'], $accountParams['country'],
            $accountParams['postalCode'], $accountParams['isAdmin']
        );
        $this->unitOfWork->registerNew($transactionId, self::$instance, $account);
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