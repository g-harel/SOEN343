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
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function getSessionByAccountId($accountId) {
        $conditionsAssociativeArray = ["account_id" => $accountId];
        return singleTableSelectAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function addSession($accountId) {
        $loginTimeStamp = date('Y-m-d G:i:s');
        $sql = "INSERT INTO `sessions`(`account_id`, `login_time_stamp`) VALUES ('$accountId', '$loginTimeStamp');";
        return $this->db->queryDB($sql);
    }

    public function deleteSessionById($id) {
        $conditionsAssociativeArray = ["id" => $id];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }

    public function deleteSessionByAccountId($accountId) {
        $conditionsAssociativeArray = ["account_id" => $accountId];
        return singleTableDeleteAccountQuery($conditionsAssociativeArray, $this->tableName);
    }
}