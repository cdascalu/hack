<?php
     //generez chestii in db;
     require_once 'Database.php';
     
     $db = new Database();
     $db->select_db();
     
//     $db->insert_qr("http://www.google.com", "http://www.lala.com", "samsung", "opera", "android", 200, 300, time());
     /*for($i=0, $nr_h = 7;$i<=30;++$i)
          $db->insert_qr(1, "http://www.lala.com", "samsung","mozilla", "IOS", 200, 300, time() - $nr_h*3600);
     
     for($i=0, $nr_h = 5;$i<=40;++$i)
          $db->insert_qr(1, "http://www.lala.com","samsung","chrome", "IOS", 200, 300, time() - $nr_h*3600);
     
     for($i=0, $nr_h = 2;$i<=60;++$i)
          $db->insert_qr(1, "http://www.lala.com", "samsung","opera", "IOS", 200, 300, time() - $nr_h*3600);*/
     
     for($i=0, $nr_h = 7;$i<=30;++$i)
          $db->insert_web(1, "http://www.lala.com", "mozilla", time() - $nr_h*3600);
     
     for($i=0, $nr_h = 5;$i<=40;++$i)
          $db->insert_web(1, "http://www.lala.com","chrome", time() - $nr_h*3600);
               
     
     for($i=0, $nr_h = 2;$i<=60;++$i)
          $db->insert_web(1, "http://www.lala.com", "opera", time() - $nr_h*3600);
     
?>
