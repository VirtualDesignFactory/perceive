<?php
namespace vdf\perceive;

use PDO;

/**
 * Provides access to the database and CRUD functionality through public methods:
 *
 * create
 * update
 * select
 * delete
 * rawsql
 *
 */
class Database
{
    // Class variables
    public $db = null;
    private static $instance = null;
    /**
     * If an instance of the database is not found
     * make an instance, otherwise return the
     * already instanciated database object
     */
    private function __construct()
    {
        // Constants from credentials file
        $dsn = "mysql:host=" . DB_HOST .
               ";port=" .      DB_PORT .
               ";dbname=" .    DB_NAME .
               ";charset=" .   DB_CHAR;
        // Create a new database connection
        try
        {
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e)
        {
            die ($e->getMessage());
        }
    }

    /**
     * Prevent cloning or serializing
     */
    private function __clone()
    {
    }
    private function __sleep()
    {
    }
    
    /**
     * Destructor
     * unset class variables
     */
    public function __destruct()
    {
        unset($this->instance);
        unset($this->db);
    }
    /**
     * Get an instance of the database connection
     *
     * @return [$instance] [An instance of the connection to the database]
     */
    public static function getHandle()
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self;
        }
        return self::$instance;
    }
    /**
     * Creates a record in a table, or if the table doesn't exist it creates the table
     * @param  [string] $table  [Table name to be used]
     * @param  [array]  $fields [Values for insertion into the table, or data types for creating a table]
     * @return [void]           [No return required]
     */
    public function create($table, $fields)
    {
        // If $feilds isn't an array return
        if (!is_array($fields))
        {
            die ('Create feilds must be a key => value array<br />');
        }
        // Create a temporary arrays so that feilds and values can be imploded correctly
        $temp_array = array();
        $temp_feild_array = array();
        $tamp_value_array = array();
        // See if the table exists or not
        if ($this->rawsql('SHOW TABLES LIKE \'' . $table . '\''))
        {
            // Sort the feilds array into an impodeable array
            foreach ($fields as $key => $value)
            {
                $temp_feild_array[] = $key;
                if (is_string($value)) {
                    $value = '\'' . $value . '\'';
                }
                $temp_value_array[] = $value;
            }
            // Build an INSERT INTO query
            $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $temp_feild_array) . ') VALUES (' . implode(', ', $temp_value_array) . ')';
        } else {
            // Sort the feilds array into an impode-able array
            foreach ($fields as $key => $value)
            {
                $new = $key . ' ' . $value;
                $temp_array[] = $new;
            }
            // Build a CREATE TABLE query
            $sql = 'CREATE TABLE ' . $table . ' ( ' . implode(', ', $temp_array) . ')';
        }
        // Send the query
        $this->rawsql($sql);
    }
    /**
     * Builds a simple select statement that will be sent to the database
     *
     * @param  [string, array]  $feilds     [Field names to be selected]
     * @param  [string]         $table      [Table name]
     * @param  [string]         $conditions [Optional - conditions for select statement]
     * @param  [string]         $sorting    [Optional - sorting statement]
     * @return [array]          $rows       [Array of select statement results]
     */
    public function select($feilds, $table, $conditions = null, $sorting = null)
    {
        // Build the query
        $sql = 'SELECT ';
        if (is_array($feilds))
        {
            $sql .= implode(', ', $feilds);
        } else {
            $sql .= $feilds;
        }
        $sql .= ' FROM ' . $table;
        if ($conditions)
        {
            $sql .= ' WHERE ' . $conditions;
        }
        if ($sorting)
        {
            $sql .= ' ' . $sorting;
        }
        // Send the query
        $rows = $this->rawsql($sql, true);
        return $rows;
    }
    /**
     * Builds a simple update statement that will be sent to the database
     *
     * @param  [string, array]  $items      [Feild names to be updated]
     * @param  [string]         $table      [Table name]
     * @param  [string]         $conditions [Conditions for uodatestatement]
     * @return [void]                       [No return required]
     */
    public function update($table, $items, $conditions)
    {
        // Build the query
        $sql = 'UPDATE ' . $table . ' SET ';
        if (is_array($items))
        {
            $sql .= implode(', ', $items);
        } else {
            $sql .= $items;
        }
        $sql .= ' WHERE ' . $conditions;
        // Send the query
        $this->rawsql($sql);
    }
    /**
     * Deletes a record in a table, or if there are no conditions it drops the table from the database
     * @param  [string] $table      [Table name to be used]
     * @param  [array]  $conditions [Optional - conditions to identify the record to be deleted]
     * @return [void]               [no return required]
     */
    public function delete($table, $conditions = null)
    {
        // Build the query
        if ($conditions == null)
        {
            $sql = 'DROP TABLE IF EXISTS ' . $table;
        } else {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $conditions;
        }
        // Send the query
        $this->rawsql($sql);
    }
    /**
     * Raw sql to get sent to the database for use when other methods are
     * not able to satisfy the desired query
     *
     * @param  [string] $sql    [String containing raw sql statement]
     * @param  [bool]   $rtn    [Return a result set in the form of an array?]
     * @return [array]  $rows   [Array containing the result of the qurey]
     */
    public function rawsql($sql, $rtn = false)
    {
        // Send the query
        try
        {
            $result = $this->db->prepare($sql);
            $result->execute();
            // If we are expecting a result to be returned, return it as an array
            if ($rtn == true) {
                $data = $result->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
