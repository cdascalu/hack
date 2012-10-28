<?php

     require_once "Database.php";
     if(isset($_POST['ad_url']))
     {
          $db = new Database();
          $db->select_db();
          
          if($_FILES['photo']['type'] == "image/jpeg" || $_FILES['photo']['type'] == "image/png")
          {
               $name = time()."_".$_FILES['photo']['name'];
               $path = "upload/".$name;
               move_uploaded_file($_FILES['photo']['tmp_name'], $path);
               $db->insert_banner($_POST['ad_url'], $_POST['qr_url'], $name,'');
			   $db->set_code();
          }
		  header('Location:index.php');          
     }
?>
<!DOCTYPE html>
<html>
     <head>
          <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
          <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css' rel='stylesheet' type='text/css'/>
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
          <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js'></script>
   
          <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
          <script type="text/javascript">
               $("#banner_form").live("submit",function(){
                  
                  var ad_url                 = $("#ad_url").attr("value");
                  var qr_url                 = $("#qr_url").attr("value");
                  var photo_url              = $("#photo_url").attr("value");
                  
                  console.log(ad_url+" "+qr_url+" "+photo_url);
                  if(ad_url.length == 0 || qr_url == 0 || photo_url.length == 0)
                  {
                       var alert_msg              = "<div class='alert'>"+"<button type='button' class='close' data-dismiss='alert'>close</button>";
                       alert_msg                  += "<strong>Error!</strong> You should complet all fields.</div>";
                       
                       $("#error_submit").html(alert_msg);
                       return false;
                  }
               });
          </script>
     </head>
     <body>
          
          <div class="container">
               <div class="row" style="background-color:purple;">
                    <h1 class="offset4" style='color:white;'>Create a banner</h1>
               </div>
               <div class="row">
                    <div class="span12">
                         <form id="banner_form" method="post" action="new_banner.php" enctype="multipart/form-data">
                              <legend>
                                   Set your banner
                              </legend>
                              <ul style="list-style:none">
                                   <li>
                                        <input id="ad_url" name="ad_url" type="text" placeHolder="ad url" />
                                   </li>
                                   <li>
                                        <input id="qr_url" name="qr_url" type="text" placeHolder="qr url" />
                                   </li>
                                   <li>
                                        <input id="photo_url" type="file" name="photo" />
                                        <span class="help-block">only jpg and png formats</span>
                                   </li>
                                   <li id="error_submit">
                                        
                                   </li>
                                   <li>
                                        <button type="submit" class="btn btn-success">done</button>
                                   </li>                                   
                              </ul>
                         </form>
                    </div>
               </div>
          </div>
          
     </body>
</html>