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

    public static function createAccountMapper($account)
    {
        $instance = new self();
        $instance->setAccount($account);
        return $instance;
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

    public function saveAccountInRecord()
    {
        $result = $this->gateway->addAccount(
            $this->account->getEmail(), $this->account->getPassword(), $this->account->getFirstName(), $this->account->getLastName(),
            $this->account->getPhoneNumber(), $this->account->getDoorNumber(), $this->account->getAppartement(),
            $this->account->getStreet(), $this->account->getCity(), $this->account->getProvince(), $this->account->getCountry(),
            $this->account->getPostalCode(), $this->account->getIsAdmin()
        );
        $isSuccessful = false;
        if ($result !== null) {
            /*$id = $result[0]["id"];
            $this->account->setId($id);*/
            $isSuccessful = true;
        }
        return $isSuccessful;
    }

    public function editAccountInRecord()
    {
        $success = $this->gateway->editAccount(
            $this->account->getId(), $this->account->getEmail(), $this->account->getPassword(), $this->account->getFirstName(), $this->account->getLastName(),
            $this->account->getPhoneNumber(), $this->account->getDoorNumber(), $this->account->getAppartement(),
            $this->account->getStreet(), $this->account->getCity(), $this->account->getProvince(), $this->account->getCountry(),
            $this->account->getPostalCode(), $this->account->getIsAdmin()
        );
        return $success;
    }

    public function deleteAccountInRecord()
    {
        $success = $this->gateway->deleteAccountByEmail($this->account->getEmail());
        return $success;
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

    public function getAccount()
    {
        return $this->account;
    }

    public function isEmailExists($email)
    {
        return AccountCatalog::getInstance()::isEmailExist($email);
    }

    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
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

    public function add($object)
    {
        // TODO: Implement add() method.
    }

    public function edit($object)
    {
        // TODO: Implement edit() method.
    }

    public function delete($object)
    {
        // TODO: Implement delete() method.
    }

    public function commit($transactionId)
    {
        $this->unitOfWork->commit($transactionId);
    }
}