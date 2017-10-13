<?php

include_once(__DIR__ . "/DatabaseGateway.php");

class UserGateway
{
    private $db;

    public function __construct() {
        $tableName = "users";
        $this->db = new SingleTableGateway($tableName);
    }

    public function getUserByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return $this->db->selectRows($conditionsAssociativeArray);
    }

    public function getUserById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return $this->db->selectRows($conditionsAssociativeArray);
    }

    public function editUser($id, $email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode) {
        $columnValuePairsAssociativeArray = [
            "email" => $email,
            "password" => $password,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "phone_number" => $phoneNumber,
            "door_number" => $doorNumber,
            "appartement" => $appartement,
            "street" => $street,
            "city" => $city,
            "province" => $province,
            "country" => $country,
            "postal_code" => $postalCode,
        ];
        $conditionsAssociativeArray = ["id" => $id];
        return $this->db->update($columnValuePairsAssociativeArray, $conditionsAssociativeArray);
    }

    public function addUser($email, $password, $firstName, $lastName, $phoneNumber,
    $doorNumber, $appartement, $street, $city, $province, $country, $postalCode, $isAdmin) {
        $columnValueAssociativeArray = [
            "email" => $email,
            "password" => $password,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "phone_number" => $phoneNumber,
            "door_number" => $doorNumber,
            "appartement" => $appartement,
            "street" => $street,
            "city" => $city,
            "province" => $province,
            "country" => $country,
            "postal_code" => $postalCode,
            "isAdmin" => $isAdmin
        ];
        return $this->db->insert($columnValueAssociativeArray);
    }

    public function deleteUserByEmail($email) {
        $conditionsAssociativeArray = ["email" => $email];
        return $this->db->delete($conditionsAssociativeArray);
    }

    public function deleteUserById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return $this->db->delete($conditionsAssociativeArray);
    }
}