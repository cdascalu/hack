<?php

     require_once 'Database.php';
     
     $db = new Database();
     $db->select_db();
     
     $bannerid=$_REQUEST['bannerid'];
     
     $res = mysql_query("SELECT COUNT(*) as cnt, browser FROM `web` WHERE bannerid='$bannerid' GROUP BY browser")or die(mysql_error(). " lala");
     
     $result = array();
     while($row = mysql_fetch_assoc($res))
     {
          $result[] = array("browser"=>$row['browser'], "cnt"=>$row['cnt']);
     }
     echo json_encode($result);
?>
