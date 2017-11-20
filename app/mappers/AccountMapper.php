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
        $record = $this->gateway->getAccountByEmail($email);
        $account = null;
        if ($record != null || $record != false) {
            $recordAccount = $record[0];
            $id = $recordAccount["id"];
            $email = $recordAccount["email"];
            $password = $recordAccount["password"];
            $firstName = $recordAccount["first_name"];
            $lastName = $recordAccount["last_name"];
            $phoneNumber = $recordAccount["phone_number"];
            $doorNumber = $recordAccount["door_number"];
            $appartement = $recordAccount["appartement"];
            $street = $recordAccount["street"];
            $city = $recordAccount["city"];
            $province = $recordAccount["province"];
            $country = $recordAccount["country"];
            $postalCode = $recordAccount["postal_code"];
            $isAdmin = $recordAccount["isAdmin"];

            $account = Account::createWithAddressDecomposed($email, $password, $firstName, $lastName, $phoneNumber,
                $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin)->setId($id);
        }
        return $account;
    }

    public function getAccountFromRecordById($accountId) {

        $identityMapId = $this->getAccountId($accountId);
        $isItemInIdentityMap = $this->identityMap->hasId($identityMapId);
        $account = null;
        if ($isItemInIdentityMap) {
            $account = $this->identityMap->getObject($identityMapId);
        } else {
            // If we fall into the else, this should be null. I put this here just in case. Don't want to break anything.
            $account = $this->accountCatalog->getAccount((string)$accountId);
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
        if(!($this->isEmailExists($account->getEmail())))
        {
            $result = $this->gateway->addAccount(
                $account->getEmail(), $account->getPassword(), $account->getFirstName(), $account->getLastName(),
                $account->getPhoneNumber(), $account->getDoorNumber(), $account->getAppartement(),
                $account->getStreet(), $account->getCity(), $account->getProvince(), $account->getCountry(),
                $account->getPostalCode(), $account->getIsAdmin()
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

    public function deleteAccountInRecord($accountId)
    {
        return $this->gateway->deleteAccountById($accountId);
        //$this->unitOfWork->registerDeleted($transactionId, $account->getId(), self::$instance, $account);
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
        return $this->gateway->getAccountByEmailPassword($email, $password);
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