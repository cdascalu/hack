<?php

     require_once 'Database.php';
     
     $db = new Database();
     $db->select_db();
     
     $bannerid=$_REQUEST['bannerid'];
     
     $res = mysql_query("SELECT *, FLOOR((UNIX_TIMESTAMP()-date)/3600) as hours, COUNT(*) as cnt FROM `web` WHERE bannerid='$bannerid' GROUP BY hours ORDER BY hours DESC");
     
     $result;
     while($row = mysql_fetch_assoc($res))
     {
          $result[] = array("hours"=>$row['hours'], "cnt"=>$row['cnt']);
     }
     echo json_encode($result);
?>
