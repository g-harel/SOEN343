<?php

namespace App\Gateway;

class AccountGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "accounts";
        $this->db = new DatabaseGateway();
    }

    public function getAccountByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getAccountById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function editAccount($id, $email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode) {
        $conditionsAssociativeArray = ["id" => $id];
        $conditions = transformConditionsToString($conditionsAssociativeArray);

        $valuePairs = "email = '$email', password = '$password', first_name = '$firstName', last_name = '$lastName',
        phone_number = $phoneNumber, door_number = $doorNumber, appartement = '$appartement', street = '$street',
        city = '$city', province = '$province', country = '$country', postal_code = '$postalCode'";

        $isConditionPresent = $conditionsAssociativeArray != null;

        $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";

        return $this->db->queryDB($sql);
    }

    public function addAccount($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin) {
        $sql = "INSERT INTO `accounts`(`email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`) VALUES ('$email', '$password', '$firstName', '$lastName', $phoneNumber, $doorNumber, '$appartement', '$street', '$city', '$province', '$country', '$postalCode');";

        $result = $this->db->queryDB($sql);
        return $result;
    }

    public function getAccountByEmailPassword($email, $password) {
        $conditionsAssociativeArray = ["email" => $email, "password" => $password];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteAccountByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteAccountById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getAll()
    {
        return getAllFromTable($this->tableName);
    }
}