<?php

// Server part for Ajax requests

namespace home\cabox\workspace\basic\web\test;
require 'TaskDb.php';


    /* AddTask function */
    function addTask($link, $description){
        //SQL injection protect??
        $sql = 'INSERT INTO Tasks SET Description = "'.$description.'"' ;
        return mysqli_query($link, $sql); 
    }
  
    function addLog($link, $lastid, $log_type){
      
        if ($_SERVER['REMOTE_ADDR']) {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        else {
         $ip = "not defined";
        }
      
       $sql = 'INSERT INTO Logs SET idTask ='.$lastid.', ip = "'.$ip.'", Time = "'.date("Y-m-d H:i:s",time()).'", Type = "'.$log_type.'"';
       return mysqli_query($link, $sql); 
    } 
    
    function deleteTask($link,$idTask){
      $sql = 'DELETE FROM Tasks WHERE idTask ='. $idTask;
      $result = mysqli_query($link, $sql);
    }
 
  

  $link = TaskDb::getInstance()->getLink();
  mysqli_set_charset($link, "utf8");
    
  // Add new Task  
  if (isset($_POST['add'])) {
    addTask($link, $_POST['add']);  
    $lastid = mysqli_insert_id($link);
    addLog($link, $lastid, 'Insert');
	}

  //Delete Task
  if (isset($_POST['delete'])) {
    $idDelete = $_POST['delete'];
    deleteTask ($link, $idDelete);
    addLog($link, $idDelete, "Delete");
	}
    
  //Refresh ToDo list
  $sql = 'Select * FROM Tasks';
  $result = mysqli_query($link, $sql);
  if ($result == false) {
      $res = [];
  }
  else {
      while ($row = mysqli_fetch_array($result)) {
        $res[] = $row;   
      }
  }
  echo  json_encode($res);
  
?>