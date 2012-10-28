<?php
     
     class Database
     {
          var $connection;
          var $db_name;
          function __construct()
          {
              $this->connection = mysql_connect("mysql5.hostbase.net",'hostingr_hack','123hack');
			  if(!$this->connection) die("database construct error"); 
          }
          function select_db($name="hostingr_hack")//selectez baza de date
          {
               $this->db_name = $name;
               mysql_select_db($this->db_name);
          }
          
          
          function insert_web($bannerid, $url, $browser, $time)
          {
               //echo $host." ".$url." ".$browser." ".$time;
               mysql_query("INSERT INTO `web`(date, bannerid, url, browser) VALUES($time, '$bannerid', '$url', '$browser')")or die(mysql_error()." insert mysql");
              
          }
          function insert_qr($bannerid, $url, $type, $browser, $os, $width, $height, $time)
          {
               mysql_query("INSERT INTO `qr`(date,bannerid,url,type,browser,os,width,height) VALUES($time,'$bannerid','$url', '$type', '$browser', '$os', $width, $height)")or die(mysql_error()." insert qr");
          }
		  function insert_banner($weburl,$qrurl,$img,$code)
          {
               mysql_query("INSERT INTO `banners`(weburl,qrurl,image,code) VALUES('$weburl', '$qrurl', '$img', '$code')")or die(mysql_error()." insert banner");
          }
		  
		  function set_code()
		  {
		  	mysql_query("UPDATE `banners` set `code`='<a href=\"http://hack.hostingro.net/code/banner.php?id=".mysql_insert_id()."\"><img src=\"http://hack.hostingro.net/qr/test.php?id=".mysql_insert_id()."\"></a>' WHERE id=".mysql_insert_id());
		  }
     }
?>