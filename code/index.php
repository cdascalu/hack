<?php
     require_once 'Database.php';
     
     $db = new Database();
     $db->select_db();
     
     $res = mysql_query("SELECT * FROM `banners`");
?>
<!DOCTYPE html>
<html>
     <head>
          <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
          <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css' rel='stylesheet' type='text/css'/>
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
          <script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js'></script>
   
          <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
          
          <script type="text/javascript" src="https://www.google.com/jsapi">
          </script>
          
          <script type="text/javascript">
               function draw_pie(vec, first, second, title, elem_id)//first ex browser type, second :ex cnt
               {
                     var data = new google.visualization.DataTable();
                      data.addColumn('string', 'Topping');
                      data.addColumn('number', 'Slices');
                      
                      $.each(vec, function(item,val){
                           
                         data.addRow([val[first], parseInt(val[second])]);
                      
                    });
                    
                    var options = {'title':title,
                                   'width':400,
                                   'height':300};

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById(elem_id));
                    chart.draw(data, options);
               }
               function draw_chart_browser() {

                 //geting data
                 var browsers;
                 var bannerid = $("#bannerid").attr("value");
                 
                 if(bannerid.length == 0)
                      return;
                 
                 $.getJSON("browser_chart.php",{bannerid:bannerid},function(dt){
                      
                      browsers = dt;
                      
                      draw_pie(browsers,"browser", "cnt", 'most used browsers', "chart_div_browser");
//                      var data = new google.visualization.DataTable();
//                      data.addColumn('string', 'Topping');
//                      data.addColumn('number', 'Slices');
//                      
//                      $.each(browsers, function(item,val){
//                           
//                         data.addRow([val['browser'], parseInt(val['cnt'])]);
//                      
//                    });
//                    
//                    var options = {'title':'Care este cel mai folosit browser',
//                                   'width':400,
//                                   'height':300};
//
//                    // Instantiate and draw our chart, passing in some options.
//                    var chart = new google.visualization.PieChart(document.getElementById('chart_div_browser'));
//                    chart.draw(data, options);
                 })
                 
               }
               function draw_chart_hits() {
                 
                 var bannerid = $("#bannerid").attr("value");
                 if(bannerid.length == 0)
                      return;
                 
                 $.getJSON("hits_chart.php",{bannerid:bannerid},function(dt){
                      
                      var arr = new Array();
                      arr.push(['hour', 'hits']);

                      $.each(dt, function(item,val){
                           
                           arr.push([parseInt(-val['hours']), parseInt(val['cnt'])]);
                      })
                      var data = google.visualization.arrayToDataTable(arr);
                      
                       var options = {
                         title: 'Hits graphic',
                         hAxis: {title: 'hours',  titleTextStyle: {color: 'red'}}
                       };

                       var chart = new google.visualization.AreaChart(document.getElementById('chart_div_hits'));
                       chart.draw(data, options);

                 });
               }
               
               function show_web_charts()
               {
                    //browser chart
               
                    //===================================================================
                    // Load the Visualization API and the piechart package.
                    google.load('visualization', '1.0', {'packages':['corechart']});

                    // Set a callback to run when the Google Visualization API is loaded.
                    google.setOnLoadCallback(draw_chart_browser);

                    // Callback that creates and populates a data table,
                    // instantiates the pie chart, passes in the data and
                    // draws it.
                    
                    //hits chart
                    //==========================================================================
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(draw_chart_hits);
               }
               
               function draw_qr_hits()
               {
                    var bannerid = $("#bannerid").attr("value");
                    if(bannerid.length == 0)
                         return;

                    $.getJSON("qr_hits.php",{bannerid:bannerid},function(dt){

                         var arr = new Array();
                         arr.push(['hour', 'hits']);
                         $.each(dt, function(item,val){
                              
//                              console.log(val);
                              arr.push([parseInt(-val['hours']), parseInt(val['cnt'])]);
                         })
                         var data = google.visualization.arrayToDataTable(arr);

                          var options = {
                            title: 'Hits graphic',
                            hAxis: {title: 'hours',  titleTextStyle: {color: 'red'}}
                          };

                          var chart = new google.visualization.AreaChart(document.getElementById('qr_div_hits'));
                          chart.draw(data, options);

                    });
               }
               function draw_qr_data()
               {
                    var bannerid = $("#bannerid").attr("value");
                    if(bannerid.length == 0)
                         return;
                    
                    var arr = new Array("type", "browser", "os");
                    console.log("DA");
                    $.each(arr, function(index,val){
                       
                       $.getJSON("qr_data.php",{bannerid:bannerid,field:val},function(dt){
                            console.log(dt);
                            draw_pie(dt, val, "cnt", val+" "+"graphic", "qr_div_" + val);
                       })
                       
                    });
               }
               function show_qr_charts()
               {
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(draw_qr_hits);
                    
                    google.load("visualization", "1", {packages:["corechart"]});
                    google.setOnLoadCallback(draw_qr_data);
               }
          </script>
          <script type="text/javascript">
               var now = "web_charts";
               function change_nav()
               {
                    var aux = $("#show_second").html();
                              
                    $("#show_second").html($("#show_main").html());

                    $("#show_main").html(aux);
               }
               
               $(document).ready(function(){
                    
                    $("#show_web_charts").live("click",function(){
                              
                              if(now == "web_charts")
                                   return;
                              
//                              change_nav();
                              $("#show_second").css("display","none");
                              $("#show_main").css("display","inline");
                              now = "web_charts";
                    });
                    
                    $("#show_qr_charts").live("click",function(){
                         
                              if(now == "qr_charts")
                                   return;
                              
//                              change_nav();
                              $("#show_second").css("display", "inline");
                              $("#show_main").css("display", "none");
                              now = "qr_charts";
                    });
                    
                    $(".nav li").live("click",function(){
                         
                         $(this).parent().find(".active").removeClass("active");
                         
                         $(this).addClass("active");
                         
                    })
                    
                    $("#get_code").live("click",function(){
                         
                         alert($(this).attr("value"));
                         
                    })
                    
                    $("#banner_place").html($("#get_code").attr("value"));
               });
          </script>
     </head>
     <html>
          <div class="container">
               <a href="index.php" style="cursor:pointer;">
                    <div class="row" style="background-color:purple;">
                         <h1 class="offset4" style='color:white;'>Check your banners</h1>
                    </div>
               </a>
               
               <div class="row-fluid">
                    <div class="span4">
                         <div class="affix">
                              <div class="row-fluid">
                                   <form method="GET">
                                        <legend>
                                             Type your banner id
                                        </legend>
                                        <input name="bannerid" type="text" placeHolder="banner id">
                                   </form>
                              </div>
                              <div class="row-fluid">
                                   <?php
                                   echo "<ul class='nav nav-tabs nav-stacked'>";
                                        $class = "";
                                        $code = "";
                                        while($row = mysql_fetch_assoc($res))
                                        {
                                             if($row['id'] == $_GET['bannerid'])
                                             {
                                                  $class = "active";
                                                  $code = $row['code'];
                                             }
                                             
                                             echo "<li class='$class'><a href='index.php?bannerid=".$row['id']."'>banner ".$row['id']."</a></li>";
                                             $class = "";
                                        }
                                   echo "</ul>";
                                   
                                   ?>
                              </div>
                              <?php
                                   if(isset($_GET['bannerid']))
                                   {
                                        echo "<div class='row-fluid'>";
                                             echo "<button id='get_code' value='".$code."' class='btn-mini'>get code for banner ".$_GET['bannerid']."</button>";
                                        echo "</div>";
                                   }
                              ?>
                         </div>
                    </div>
               
               <?php
                    if(isset($_GET['bannerid']))
                    {
               ?>
                    <script type="text/javascript">
                         show_web_charts();
                         show_qr_charts();
                    </script>
                    
                    
                    <div class="span8" style="border-left:1px solid gray;">
                         <div class="navbar">
                              <div class="navbar-inner">
                                   <a class="brand" href="#">Insights</a>
                                   <ul class="nav">
                                        <li class="active"><a href="#" id="show_web_charts">web banner</a></li>
                                        <li><a id="show_qr_charts" href="#">qr banner</a></li>
                                   </ul>
                              </div>
                         </div>
                    
               <?php
                    }
               ?>
                         <div id="show_main" class="row-fluid">
                              <div class="row-fluid">
                                   <div class="span8 offset2">
                                        <div id="chart_div_browser"></div>
                                   </div>
                              </div>
                              <div class="row-fluid">
                                   <div class="span12">
                                        <div id="chart_div_hits"></div>
                                   </div>
                              </div>
                         </div>
                         <div id="show_second" class="row-fluid" style="display: none;">
                              
                              <div class="row-fluid">
                                   <div class="span12">
                                        <div id="qr_div_hits"></div>
                                   </div>
                              </div>
                              
                              <div class="row-fluid">
                                   <div class="span3 offset4">
                                        <h4>Mobile details</h4>
                                   </div>
                              </div>
                              
                              <div class="row-fluid">
                                   <div class="span6">
                                        <div id="qr_div_type"></div>
                                   </div>
                                   
                                   <div class="span6">
                                        <div id="qr_div_os"></div>
                                   </div>
                              </div>
                              <div class="row-fluid">
                                   <div class="span6 offset3">
                                        <div id="qr_div_browser"></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <?php
                    if(isset($_GET['bannerid']))
                    {
                         echo "<div id='banner_place' class='row'>";
                              
                         echo "</div>";
                    }
               ?>
               <div class="row">
                    <div class="span2 offset10">
                         <a href="new_banner.php"><button class="btn btn-large btn-primary">new banner</button></a>
                    </div>
               </div>
               <div class="row" style="height:20px;"></div>
          </div>
          
          <input type="hidden" id="bannerid" value="<?php echo $_GET['bannerid'];?>" />
     </html>
</html>
