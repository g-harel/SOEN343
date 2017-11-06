<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;

class SessionGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "sessions";
        $this->db = new DatabaseGateway();
    }

    public function getSessionCatalog(){
        return getAllSessions($this->tableName);
    }

    public function getSessionById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableSelectUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getSessionByUserId($userId) {
        $conditionsAssociativeArray = ["user_id" => $userId];
        return singleTableSelectUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function addSession($userId) {
        $loginTimeStamp = date('Y-m-d G:i:s');
        $sql = "INSERT INTO `users`(`user_id`, `login_time_stamp`) VALUES ('$userId', '$loginTimeStamp');";
        return $this->db->queryDB($sql);
    }

    public function deleteSessionById($email) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteUserQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteSessionByUserId($userId) {
        $conditionsAssociativeArray = ["user_id" => $userId];
        return singleTableDeleteUserQuery($conditionsAssociativeArray, $this->tableName);
    }
}