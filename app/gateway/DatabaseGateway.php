<?php

namespace App\Gateway;

use Mysqli;
use Illuminate\Support\Facades\Log;

// log result in the client console and storage/logs/laravel.logs
Function log_info($str) {
    echo "<script>console.log('".addslashes(json_encode($str))."');</script>\n";
    Log::info(json_encode($str));
}

// log errors in the client console and storage/logs/laravel.logs
Function log_error($str) {
    if ($str) {
        echo "<script>console.error('".addslashes(json_encode($str))."');</script>\n";
        Log::error(json_encode($str));
    }
}

Function singleTableSelectAccountQuery($conditionsAssociativeArray, $tableName) {
    $conditions = transformConditionsToString($conditionsAssociativeArray);
    $sql = "SELECT * FROM $tableName";
    if (trim($conditions)) {
        $sql .= " WHERE $conditions;";
    } else {
        $sql .= ";";
    }
    $db = new DatabaseGateway();
    $result = $db->queryDB($sql);
    if ($result !== null) {
        return parseSelectResult($result);
    } else {
        return null;
    }
}

Function singleTablePseudoDeleteQuery($conditionsAssociativeArray, $tableName) {
    $conditions = transformConditionsToString($conditionsAssociativeArray);
    $sql = "UPDATE $tableName SET isDeleted = '1' WHERE $conditions;";
    $db = new DatabaseGateway();
    return $db->queryDB($sql);
}

Function singleTableDeleteAccountQuery($conditionsAssociativeArray, $tableName) {
    $conditions = transformConditionsToString($conditionsAssociativeArray);
    $sql = "DELETE FROM $tableName WHERE $conditions;";
    $db = new DatabaseGateway();
    return $db->queryDB($sql);
}

Function implodeAssociativeArray($associativeArray, $connector) {
    $length = count($associativeArray);
    $conditions = "";
    foreach ($associativeArray as $key => $value){
        $length--;
        $conditions .= $key . " = '" . $value . "'";
        if($length) {
            $conditions .= "$connector";
        }
    }
    return $conditions;
}

// fetch data from a query result.
Function parseSelectResult($queryResults) {
    $isQueryResultsExist = $queryResults != null;
    $result = null;
    if ($isQueryResultsExist) {
        while ($row = $queryResults->fetch_assoc()) {
            $result[] = $row;
        }
    }
    return $result;
}

Function transformConditionsToString($connectionsAssociativeArray) {
    $separatorStringBetweenConditions = " AND ";
    return implodeAssociativeArray($connectionsAssociativeArray, $separatorStringBetweenConditions);
}

// pluck the keys from the source object and accumulate them into an array.
Function cherryPick($keys, $source) {
    $result = array();
    if (is_object($source)) {
        $source = get_object_vars($source);
    }
    foreach ($keys as &$key) {
        if (isset($source["$key"])){
            array_push($result, $source["$key"]);
        }
    }
    return $result;
}

class DatabaseGateway
{
    private $DBConnection;
    private $serverName;
    private $userName;
    private $password;
    private $databaseName;

    public function __construct() {
        $configPath = dirname(__FILE__, 3) . "/databaseConfig.ini";
        $configArray = parse_ini_file($configPath);
        $this->serverName = $configArray["serverName"];
        $this->userName = $configArray["userName"];
        $this->password = $configArray["password"];
        $this->databaseName = $configArray["databaseName"];
    }

    public function getDBConnection() {
        return $this->DBConnection;
    }

    public function openDBConnection() {
        $this->DBConnection = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
    }

    public function closeDBConnection() {
        mysqli_close($this->DBConnection);
    }

    // supports multiple queries.
    // returns the result of the last query.
    public function queryDB($sql) {
        $this->openDBConnection();
        $toReturn = $this->manualQueryDB($sql);
        // Returns the ID of the last insertion
        if ($this->isInsert($sql)) {
            $toReturn = $this->DBConnection->insert_id;
        }
        $this->closeDBConnection();
        return $toReturn;
    }

    public function manualQueryDB($sql, $returnIndex = null) {
        log_info($sql);
        $conn = $this->DBConnection;
        $result = $conn->multi_query($sql);
        $returned = array();
        if (!$result) {
            // TODO remove
            log_error($conn->error);
            return null;
        }
        $returned[0] = $conn->store_result();
        $count = 0;
        while ($conn->more_results()) {
            $count++;
            $conn->next_result();
            $result = $conn->store_result();
            if($result) {
                $returned[$count] = $result;
            } else {
                // TODO remove
                log_error($conn->error);
            }
        }
        // if the return index is not a number or if it is larger than the
        // number of results, the last result is returned.
        if (!is_int($returnIndex) || $returnIndex > count($returned)) {
            $returnIndex = count($returned) - 1;
        }
        if ($returnIndex < 0) {
            $returnIndex = 0;
        }
        return $returned[$returnIndex];
    }

    private function isInsert($statement) {
        return substr($statement, 0, 6) === "INSERT";
    }
}

// gateway with included helper methods for dealing with a simple table.
