<?php
class DatabaseGateway
{
    private $DBConnection;
    private $serverName;
    private $userName;
    private $password;
    private $databaseName;
    private $tableName;

    public function __construct($tableName) {
        $this->serverName = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->databaseName = "soen343";
        $this->tableName = $tableName;
    }

    private function openDBConnection() {
        $this->DBConnection = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
    }

    private function closeDBConnection() {
        mysqli_close($this->DBConnection);
    }

    private function queryDB($sql) {
        $this->openDBConnection();
        $query = $this->DBConnection->query($sql);
        $this->closeDBConnection();
        return $query;
    }

    private static function implodeAssociativeArray($associativeArray, $connector) {
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

    private static function parseSelectResult($queryResults) {
        $isQueryResultsExist = $queryResults != null;
        $result = null;
        if ($isQueryResultsExist) {
            while ($row = $queryResults->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    private static function transformConditionsToString($connectionsAssociativeArray) {
        $separatorStringBetweenConditions = " AND ";
        return self::implodeAssociativeArray($connectionsAssociativeArray, $separatorStringBetweenConditions);
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
            $conditions = $this::transformConditionsToString($conditionsAssociativeArray);
            $sql = "SELECT $fields FROM $this->tableName WHERE $conditions;";
        } else {
            $sql = "SELECT $fields FROM $this->tableName;";
        }
        $result = $this->queryDB($sql);
        return $this::parseSelectResult($result);
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
        $valuePairs = $this::implodeAssociativeArray($columnValuePairsAssociativeArray, ", ");
        $sql = "";
        $isConditionPresent = $conditionsAssociativeArray != null;        
        if ($isConditionPresent) {
            $conditions = $this::transformConditionsToString($conditionsAssociativeArray);            
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
        $conditions = $this::transformConditionsToString($conditionsAssociativeArray);
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
    public function innerJoin($tableArray, $selectFieldsArray) {
        // Concatenates all the columns to a string separated by ,
        $fields = implode(", ", array_keys($selectFieldsArray));
        // Gets all the values into an array
        $valuesArray = array_values($columnValueAssociativeArray)
        // Add ' ' in front of each values for SQL syntax
        foreach ($valuesArray as $value){
            $value = "'$value'";
        }
        $values = implode(", ", $valuesArray);
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return this->DBConnection->query($sql);
    }



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