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
        $this->serverName = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->databaseName = "soen343";
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
class SingleTableGateway extends DatabaseGateway
{
    private $tableName;

    public function __construct($tableName) {
        parent::__construct();
        $this->tableName = $tableName;
    }

    /**
     * Select all values that match a specifc condition
     * $selectFieldsArray = is an Array of all the columns you want to select
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     *
     * This function returns an array of associative arrays. Every index of the first array represent a row.
     * Every columns of a row are represented in the associative array under the convention "COLUMN_NAME" => "VALUE"
     */
    public function selectFields($selectFieldsArray, $conditionsAssociativeArray = null) {
        $fields = implode(", ", $selectFieldsArray);
        $sql = "";
        $isConditionPresent = $conditionsAssociativeArray != null;
        if ($isConditionPresent) {
            $conditions = transformConditionsToString($conditionsAssociativeArray);
            $sql = "SELECT $fields FROM $this->tableName WHERE $conditions;";
        } else {
            $sql = "SELECT $fields FROM $this->tableName;";
        }
        $result = $this->queryDB($sql);
        return parseSelectResult($result);
    }

    /**
     * Select all the rows that match a specific condition
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     *
     * This function returns an array of associative arrays. Every index of the first array represent a row.
     * Every columns of a row are represented in the associative array under the convention "COLUMN_NAME" => "VALUE"
     */
     public function selectRows($conditionsAssociativeArray = null) {
        $selectRows = ["*"];
        return $this->selectFields($selectRows, $conditionsAssociativeArray);
    }

    /**
     * Update all values that match a specifc condition
     * $columnValuePairsAssociativeArray = Associative array where [key => value] where the key is the column name and value
     * is what the new value should be in the DB
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     *
     * This function returns a boolean of whether it worked or not.
     */
    public function update($columnValuePairsAssociativeArray, $conditionsAssociativeArray = null) {
        $valuePairs = implodeAssociativeArray($columnValuePairsAssociativeArray, ", ");
        $sql = "";
        $isConditionPresent = $conditionsAssociativeArray != null;
        if ($isConditionPresent) {
            $conditions = transformConditionsToString($conditionsAssociativeArray);
            $sql = "UPDATE $this->tableName SET $valuePairs WHERE $conditions;";
        } else {
            $sql = "UPDATE $this->tableName SET $valuePairs;";
        }
        return $this->queryDB($sql);
    }

    /**
     * Deletes all values that match a specifc condition
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     *
     * This function returns a boolean of whether it worked or not.
     */
    public function delete($conditionsAssociativeArray = null) {
        $conditions = transformConditionsToString($conditionsAssociativeArray);
        $sql = $sql = "DELETE FROM $this->tableName WHERE $conditions;";
        return $this->queryDB($sql);
    }

    /**
     * Inserts a value in a specific table. The "key" is the column name and "value" is the value to be placed.
     * $columnValueAssociativeArray = Associative array where [column => value]
     *
     * This function returns a boolean of whether it worked or not.
     */
    public function insert($columnValueAssociativeArray) {
        // Concatenates all the columns to a string separated by ,
        $columns = implode(", ", array_keys($columnValueAssociativeArray));
        // Gets all the values into an array
        $valuesArray = array_values($columnValueAssociativeArray);
        // Add ' ' in front of each values for SQL syntax
        $valueCount = count($valuesArray);
        $sql = "INSERT INTO $this->tableName ($columns) VALUES (";
        foreach($valuesArray as $value) {
            $valueCount--;
            $sql .= "'".$value."'";
            if ($valueCount) {
                $sql .= ", ";
            }
        }
        $sql .= ");";
        echo($sql);
        $values = implode(", ", $valuesArray);
        return $this->queryDB($sql);
    }
/*
    SELECT title, m2.txt1 AS teaser, inputdat, db_file.*
    FROM db_item
        INNER JOIN db_itemv AS m1 USING(id_item)
        INNER JOIN db_itemf USING(id_item)
        INNER JOIN db_itemd USING(id_item)
        LEFT JOIN  db_itemv AS m2
            ON db_item.id_item = m2.id_item
            AND ( m2.fldnr = '123' OR m2.fldnr IS NULL )
    WHERE type=15
        AND m1.fldnr = '12'
        AND m1.indik = 'b'
        AND m1.txt1s = 'en'
        AND visibility = 0
        AND inputdat > '2005-11-02'
    GROUP BY title
    ORDER BY inputdat DESC

    SELECT s.studentname
        , s.studentid
        , s.studentdesc
        , h.hallname
    FROM students s
    INNER JOIN hallprefs hp
        on s.studentid = hp.studentid
    INNER JOIN halls h
        on hp.hallid = h.hallid

*/
}