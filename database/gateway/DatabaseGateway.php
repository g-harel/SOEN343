<?php
class DatabaseGateway
{
    private $DBConnection;
    private $serverName;
    private $userName;
    private $password;

    public function DatabaseGateway() {
        $this->serverName = "localhost";
        $this->userName = "soen343";
        $this->password = "";
    }

    private function openDBConnection() {
        $this->DBConnection = new mysqli($serverName, $userName, $password);
    }

    private function closeDBConnection() {
        mysqli::close($this->DBConnection);
    }

    private function queryDB($sql) {
        $this->openDBConnection();
        $query = $this->DBConnection->query($sql);
        $this->closeDBConnection();
        return $query;
    }

    private static function implodeConditionsAssociativeArray($connectionsAssociativeArray) {
        $length = count($connectionsAssociativeArray);
        $conditions = "";
        foreach ($connectionsAssociativeArray as $key => $value){
            $count--;
            $conditions .= $key . " = " . $value;
            if($count) {
                $conditions .= " AND ";
            }
        }
        return $conditions;
    }

    /**
     * Select all values that match a specifc condition
     * $table = string
     * $selectFieldsArray = is an Array of all the columns you want to select
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     */
    public function select($table, $selectFieldsArray, $conditionsAssociativeArray) {
        $fields = implode(", ", $selectFieldsArray);
        $conditions = $this::implodeConditionsAssociativeArray($conditionsAssociativeArray);
        $sql = "";
        $isConditionPresent = count($conditionsAssociativeArray);
        if ($isConditionPresent) {
            $sql = "SELECT $fields INTO $table WHERE $conditions\;";
        } else {
            $sql = "SELECT $fields INTO $table\;";
        }
        return $this->queryDB($sql);
    }

    /**
     * Update all values that match a specifc condition
     * $table = string
     * $columnValuePairsAssociativeArray = Associative array where [key => value] where the key is the column name and value
     * is what the new value should be in the DB
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     */
    public function update($table, $columnValuePairsArray, $conditionsAssociativeArray) {
        $valuePairs = implode(", ", $columnValuePairsArray);
        $conditions = $this::implodeConditionsAssociativeArray($conditionsAssociativeArray);
        $sql = "";
        $isConditionPresent = count($conditionsAssociativeArray);
        if ($isConditionPresent) {
            $sql = "UPDATE $table SET $valuePairs WHERE $conditions\;";
        } else {
            $sql = "UPDATE $table SET $valuePairs\;";
        }
        return $this->queryDB($sql);
    }

    /**
     * Deletes all values that match a specifc condition
     * $table = string
     * $conditionsAssociativeArray = Associative array where [key => value]  ==> key is the first condition and value is what
     * this condition needs to equal to.
     */
    public function delete($table, $conditionsAssociativeArray) {
        $conditions = $this->implodeConditionsAssociativeArray($conditionsAssociativeArray);
        $sql = $sql = "DELETE FROM $table WHERE $conditions\;";
        return $this->queryDB($sql);
    }

    /**
     * Inserts a value in a specific table. The "key" is the column name and "value" is the value to be placed.
     * $table = string
     * $columnValueAssociativeArray = Associative array where [key => value]
     */
    public function insert($table, $columnValueAssociativeArray) {
        // Concatenates all the columns to a string separated by ,
        $columns = implode(", ", array_keys($columnValueAssociativeArray));
        // Gets all the values into an array
        $valuesArray = array_values($columnValueAssociativeArray);
        // Add ' ' in front of each values for SQL syntax
        foreach($valuesArray as $value) {
            $value = "'$value'";
        }
        $values = implode(", ", $valuesArray);
        $sql = "INSERT INTO $table \($columns\) VALUES \($values\)\;";
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