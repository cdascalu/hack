<?php

     require_once 'Database.php';
     
     $db = new Database();
     $db->select_db();
     
     $bannerid               = $_REQUEST['bannerid'];
     $field                   = $_REQUEST['field'];
     
     $res = mysql_query("SELECT COUNT(*) as cnt, $field FROM `qr` WHERE bannerid='$bannerid' GROUP BY $field")or die(mysql_error()." qr error");
     
     $result;
     while($row = mysql_fetch_assoc($res))
     {
          $result[] = array($field=>$row[$field],"cnt"=>$row['cnt']);
     }
     echo json_encode($result);
?>
