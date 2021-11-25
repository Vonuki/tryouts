<?php

namespace  home\cabox\workspace\basic\web\test;

// Connection to DB 
class TaskDb 
{ 
    /**
     * singelton
     */
    private static $db_instance;
    private $link;

    /**
     * hide constructor
     */
    protected function __construct() { 
       $this->link = mysqli_connect("localhost", "root", "", "report");
       if ($this->link == false){
          print("Error to conect to  MySQL <br>" . mysqli_connect_error());
        }
       else{
         
         // sql to create table Logs 
          $sql = "CREATE TABLE IF NOT EXISTS `Logs` (
            idLog INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            idTask INT(6) NOT NULL,
            ip VARCHAR(20) NOT NULL,
            Type VARCHAR(20),
            Time DATETIME
          )";

          if (mysqli_query($this->link,$sql) === TRUE) { } else {echo "Error creating table  Logs"; }
         
         // sql to create table Tasks
          $sql = "CREATE TABLE IF NOT EXISTS `Tasks` (
            idTask INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Description VARCHAR(100) NOT NULL
          )";

          if (mysqli_query($this->link,$sql) === TRUE) { } else {echo "Error creating table  Tasks"; }

         
       }
    }

    /**
     * hide cloning.
     */
    protected function __clone() { }

    /**
     * hide wakeup.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * instance access
     */
    public static function getInstance(): TaskDb
    {
        if (!isset(self::$db_instance)) {
            self::$db_instance = new static;
        }

        return self::$db_instance;
    }

    /**
     * link for instance
     */
    public function getLink()
    {
        return $this->link;
    }
}