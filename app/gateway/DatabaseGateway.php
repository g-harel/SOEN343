<?php

namespace App\Gateway;

use Mysqli;

// log result in the client console.
function console_log($str) {
    echo "<script>console.log('".addslashes(json_encode($str))."')</script>\n";
}

// log errors in the client console.
function console_error($str) {
    if ($str) {
        echo "<script>console.error('".addslashes(json_encode($str))."')</script>\n";
    }
}

function implodeAssociativeArray($associativeArray, $connector) {
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
function parseSelectResult($queryResults) {
    $isQueryResultsExist = $queryResults != null;
    $result = null;
    if ($isQueryResultsExist) {
        while ($row = $queryResults->fetch_assoc()) {
            $result[] = $row;
        }
    }
    return $result;
}

function transformConditionsToString($connectionsAssociativeArray) {
    $separatorStringBetweenConditions = " AND ";
    return implodeAssociativeArray($connectionsAssociativeArray, $separatorStringBetweenConditions);
}

// pluck the keys from the source object and accumulate them into an array.
function cherryPick($keys, $source) {
    $result = array();
    $sourceValues = get_object_vars($source);
    foreach ($keys as &$key) {
        array_push($result, $sourceValues["$key"]);
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
        $configPath = dirname( __FILE__, 3 ) . "\databaseConfig.ini";
        $configArray = parse_ini_file($configPath);
        $this->serverName = $configArray["serverName"];
        $this->userName = $configArray["userName"];
        $this->password = $configArray["password"];
        $this->databaseName = $configArray["databaseName"];
    }

    private function openDBConnection() {
        $this->DBConnection = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
    }

    private function closeDBConnection() {
        mysqli_close($this->DBConnection);
    }

    // supports multiple queries.
    // returns the result of the last query.
    public function queryDB($sql) {
        $this->openDBConnection();
        // TODO remove
        console_log($sql);
        $conn = $this->DBConnection;
        $result = $conn->multi_query($sql);
        $returned = array();
        if ($result) {
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
                    console_error($conn->error);
                }
            }
        } else {
            // TODO remove
            console_error($conn->error);
        }
        $this->closeDBConnection();
        return $returned[count($returned) - 1];
    }
}

// gateway with included helper methods for dealing with a simple table.
