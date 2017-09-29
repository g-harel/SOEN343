<?php

include_once(__DIR__ . "/DatabaseGateway.php");

class SessionGateway
{
    private $db;

    public function __construct() {
        $tableName = "sessions";
        $this->db = new DatabaseGateway($tableName);
    }

    public function getSessionById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return $this->db->selectRows($conditionsAssociativeArray);
    }

    public function getSessionByUserId($userId) {
        $conditionsAssociativeArray = ["user_id" => $userId];
        return $this->db->selectRows($conditionsAssociativeArray);
    }

    public function addSession($userId) {
        $loginTimeStamp = date('Y-m-d G:i:s');
        $columnValueAssociativeArraysql = [
            "user_id" => $userId,
            "login_time_stamp" => $loginTimeStamp
        ];
        return $this->db->insert($columnValueAssociativeArraysql);        
    }

    public function deleteSessionById($email) {
        $conditionsAssociativeArray = ["id" => $id];
        return $this->db->delete($conditionsAssociativeArray);
    }

    public function deleteSessionByUserId($userId) {
        $conditionsAssociativeArray = ["user_id" => $userId];
        return $this->db->delete($conditionsAssociativeArray);
    }
}