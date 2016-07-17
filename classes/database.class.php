<?php
/**
 * database.class.php
 */
namespace Dynamics;

/**
 * MySQLi database routines
 * Class dbMySQLi
 * @package Dynamics
 */
Class dbMySQLi
{

    /**
     * @var array of db connect values
     */
    private $ar = array(
        'host' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'port' => '',
        'socket' => '',
        'table' => ''
    );

    /**
     * CONNECT
     * dbMySQLi constructor.
     * @param $db_config
     */
    function __construct($db_config)
    {
        //CONFIG
        $this->ar['host'] = $db_config['host'];
        $this->ar['username'] = $db_config['username'];
        $this->ar['database'] = $db_config['database'];
        $this->ar['password'] = $db_config['password'];
        $this->ar['port'] = $db_config['port'];
        $this->ar['socket'] = $db_config['socket'];

        //CONNECT
        $this->dbConnect();

        return TRUE;
    }


    /**
     * GETTERS
     * @param $key
     * @return string
     */
    public function get($key)
    {
        if (!array_key_exists($key, $this->ar)) {
            return '';
        }
        $rtn = $this->ar[$key];
        return $rtn;
    }
    public function get_ar()
    {
        return $this->ar;
    }


    /**
     * CONNECT - mysqli
     */
    public function dbConnect()
    {
        $this->mysqli = new \mysqli(
            $this->ar['host'],
            $this->ar['username'],
            $this->ar['password'],
            $this->ar['database'],
            $this->ar['port'],
            $this->ar['socket']
        );

        if ($this->mysqli ->connect_error) {
            die('Connect Error (' . $this->mysqli ->connect_errno .' in dbConnect() '. ') '
                . $this->mysqli ->connect_error.' Database: ' . $this->ar['database'] . '. Exiting...');
        }

    }

    /**
     * QUERY - general purpose, do all
     * @param string - $sql
     * @param $sql
     * @return mixed - a mysqli result object
     */
    public function dbQuery($sql)
    {
        $result = $this->mysqli->query($sql);
        if($result === FALSE) {
            $this->dbLogError($sql, "dbQuery");
        }
        return $result;
    }

    /**
     * READ / SELECT - read using fn with structured params
     * @param $table
     * @param string $fields
     * @param string $condition
     * @param string $orderby
     * @param string $limit
     * @return mixed
     */
    public function dbSelect($table, $fields = "*", $condition = "1", $orderby = "", $limit = "")
    {
        $sql = "SELECT " . $fields . " 
            FROM " . $table . " 
            WHERE " . $condition . ($orderby == "" ? "" : " 
            ORDER BY " . $orderby) . ($limit == "" ? "" : " 
            LIMIT " . $limit
        );

        $result = $this->mysqli->query($sql);
        if($result === FALSE) {
            $this->dbLogError($sql, "dbSelect");
        }
        return $result;
    }

    /**
     * CREATE / INSERT
     * @param type $table
     * @param type $fields
     * @param type $values
     * @return int
     */
    public function dbInsert($table, $fields, $values)
    {
        $sql = "INSERT INTO " . $table . ($fields == "" ? "" : "(" . $fields . ")") . " VALUES (" . $values . ")";

        if ($this->mysqli->query($sql)) {
            $this->last_insert_id = $this->mysqli->insert_id;
            return 1;
        } else {
            $this->dbLogError($sql, "dbInsert");
        }
    }


    /**
     * UPDATE
     * @param $table
     * @param $values
     * @param string $condition
     * @return bool
     */
    public function dbUpdate($table, $values, $condition = "1")
    {
        $sql = "UPDATE `" . $table . "` SET " . $values . " WHERE " . $condition;
        $result = $this->mysqli->query($sql);
        if ($result === TRUE) {
            $rtn = TRUE;
        } else {
            $this->dbLogError($sql, "dbUpdate");
        }
        return $rtn;
    }


    /**
     * DELETE
     * @param $table
     * @param string $condition
     * @return bool|int
     */
    public function dbDelete($table, $condition = "1")
    {
        $sql = "DELETE FROM `" . $table . "` WHERE " . $condition;
        $result = $this->mysqli->query($sql);
        if ($result === TRUE) {
            //$this->affected_rows = $this->mysqli->affected_rows;
            //return $this->affected_rows;
            return TRUE;
        } else {
            $this->dbLogError($sql, "dbDelete");
        }
    }


    /**
     * COUNT - Count items returned from the query
     * @param $table
     * @param string $field
     * @param string $condition
     * @return int
     */
    public function dbCount($table, $field = "*", $condition = "1")
    {
        $sql = "SELECT COUNT(" . $field . ") FROM $table WHERE $condition";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows > 0) {
            //COUNT - the count is held in the row
            $row = $result->fetch_row();
            return $row[0];
        }
        return FALSE;
    }


    /**
     * LOG ERROR - logs errors to file
     * @param type $sql
     * @param type $fn
     */
    public function dbLogError($sql, $fn)
    {
        //STRING
        $str = " Error in " . $fn . "() using SQL: " . $sql . " ";

        //FILE
        $filename = ERROR_LOG_FILE;
        $bytes = file_put_contents($filename, date('Y-m-d h:i:s').$str, FILE_APPEND);
        
        if ($bytes === FALSE) {
            $str =  'ERROR dbLogError(): Can\'t open this log file: ' . $filename . $str. " Exiting...";
            exit("<pre>$str</pre>\n");
        }

        echo "<pre>$str</pre>\n";
    }

    /**
     * FILTER - data integrity
     * Very useful function for data integrity
     * Handles typecasting, quotes, escape
     * Preps data for the "sprint() sql query string"
     * @param $theValue
     * @param $theType
     * @param string $theDefinedValue
     * @param string $theNotDefinedValue
     * @return string
     */
    static public function dbFilter($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        //SANITIZE
        $theValue = filter_var($theValue, FILTER_SANITIZE_STRING);

        //TYPE CAST
        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "" . $theValue . "" : "";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "";
                break;
            case "date":
                $theValue = ($theValue != "") ? "" . $theValue . "" : "";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                //echo"\nDEFINED VALUE: $theValue.\n";
                break;
        }
        return $theValue;
    }

    /**
     * Experimental fn for PHPUnit testing
     * @return string
     */
    /*
    public function myExperiment($val)
    {
      $val = "willp1203";

      $sql = "SELECT * FROM ".$table." WHERE username LIKE '".$val."%' ";
      $result = $db->mysqli->query($sql);
      $row_ar = $result->fetch_assoc();
      $val = $row_ar['username'];

      return $val;
    }
*/

}
