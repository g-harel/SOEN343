<?php

namespace App\Gateway;
use App\Gateway\DatabaseGateway;

class UserGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "users";
        $this->db = new DatabaseGateway();
    }

    public function getUserByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return singleTableSelectUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getUserById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableSelectUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function editUser($id, $email, $password, $firstName, $lastName, $phoneNumber,
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

    public function addUser($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin) {
        $sql = "INSERT INTO `users`(`email`, `password`, `first_name`, `last_name`, `phone_number`, `door_number`, `appartement`, `street`, `city`, `province`, `country`, `postal_code`, `isAdmin`) VALUES ('$email', '$password', '$firstName', '$lastName', $phoneNumber, $doorNumber, '$appartement', '$street', '$city', '$province', '$country', '$postalCode', $isAdmin);";
        return $this->db->queryDB($sql);
    }

    public function deleteUserByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return singleTableDeleteUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteUserById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteUserQuery($conditionsAssociativeArray, $this->tableName);
    }
}