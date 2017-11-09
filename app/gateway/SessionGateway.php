<?php

namespace App\Gateway;

use App\Gateway\DatabaseGateway;
use App\Models\Session;

class SessionGateway
{
    private $db;
    private $tableName;

    public function __construct() {
        $this->tableName = "sessions";
        $this->db = new DatabaseGateway();
    }

//    public function getSessionCatalog(){
//	   return getAllSessions($this->tableName);
//    }

    public function getAllSession(){
        $sql = "SELECT * FROM $this->tableName;";
        return $this->db->queryDB($sql);
    }

    public function getSessionById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getSessionByAccountId($accountId) {
        $conditionsAssociativeArray = ["account_id" => $accountId];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function addSession($accountId) {
        $loginTimeStamp = date('Y-m-d G:i:s');
        $sql = "INSERT INTO $this->tableName(`user_id`, `login_time_stamp`) VALUES ('$userId', '$loginTimeStamp');";
        return $this->db->queryDB($sql);
    }

    public function deleteSessionById($email) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteSessionByAccountId($accountId) {
        $conditionsAssociativeArray = ["account_id" => $accountId];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }
}