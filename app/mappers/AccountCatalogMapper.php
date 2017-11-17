<?php

namespace App\Mappers;

use App\Models\Account;
use App\Models\AccountCatalog;
use App\Gateway\AccountGateway;
use App\Models\Address;
use App\UnitOfWork\CollectionMapper;
use App\IdentityMap\IdentityMap;
use App\UnitOfWork\UnitOfWork;


class AccountCatalogMapper implements CollectionMapper
{
    private $gateway;
    private $accountCatalog;
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
            self::$instance = new AccountCatalogMapper();
        }
        return self::$instance;
    }

    public function getAccountFromRecordByEmail($email)
    {
        $record = $this->gateway->getAccountByEmail($email);
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

    public function getAccountFromRecordById($id) {


        $isItemInIdentityMap = $this->identityMap->hasId($identityMapId);
        $item = null;
        if ($isItemInIdentityMap) {
            $item = $this->identityMap->getObject($identityMapId);
        } else {
            // If we fall into the else, this should be null. I put this here just in case. Don't want to break anything.
            $item = $this->itemCatalog->getItem($itemId);
        }

        if ($item === null) {
            return null;
        } else {
            return $this->mapItemToDomainArray($item);
        }

        $record = $this->gateway->getAccountById($id);
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

    public function deleteAccountInRecord($transactionId, $accountId)
    {
        $account = $this->getAccountFromRecordById($accountId);
        $this->unitOfWork->registerDeleted($transactionId, $account->getId(), self::$instance, $account);
    }

    public function updateCatalog()
    {
        $accounts = $this->gateway->getAll();
        foreach ($accounts as $account)
        {
            $address = new Address($account->door_number, $account->appartement, $account->street, $account->city, $account->province, $account->country, $account->postal_code);
            $accountObject = new Account($account->email, $account->password, $account->first_name, $account->last_name, $account->phone_number, $address, $account->isAdmin);
            $accountObject->setId($account->id);
            AccountCatalog::addAccount($accountObject);
        }
    }

    public function getAllAccounts()
    {
        return AccountCatalog::getInstance()::getCatalog();
    }

    public function isEmailExists($email)
    {
        return AccountCatalog::getInstance()::isEmailExist($email);
    }

    //UTILITY
    public function getFullName()
    {
        return $this->account->getFullName();
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
        $gateway = $this->getGateway($account);
        if ($gateway === null) {
            return false;
        }
        $id = $account->getId();
        $identityMapId = $this->getItemId($id);
        $deleted = $gateway->deleteById($id);
        if ($deleted) {
            $this->identityMap->removeObject($identityMapId);
            $this->itemCatalog->removeItem($id);
        }
    }

    public function commit($transactionId)
    {
        $this->unitOfWork->commit($transactionId);
    }
}