<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ('Auth_staff.php');
session_start();
$auth = new Auth_staff();
if (!isset($_SESSION['user_id'])) 
{
	//Not logged in, send to login page.
	header( 'Location: login.php' );
}
else 
{
	//Check we have the right user
	$logged_in = $auth->checkSession();
	
	if(empty($logged_in)){
		//Bad session, ask to login
		$auth->logout();
		header( 'Location: login.php' );
}
else
{    
		//User is logged in, show the page
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ACES : HOME</title>
    <!-- Include the bootstrap stylesheets -->
    <link rel="stylesheet" href="bootstrapnew.css"/>
  
 
        </head>
  <body>
  
  <!-- Navbar
    ================================================== -->
 <div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <a class="brand" href="http://www.amrita.edu/">AMRITA</a>
       <div class="nav-collapse" id="main-menu">
        
          </li>  
              
            </ul>
          </li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="#">Welcome <?php echo ''. $_SESSION['name'] ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="/logout_stu.php">Logout <i class="icon-share-alt"></i></a></li>
        </ul>
       </div>
     </div>
   </div>
 </div>

    <div class="container">
    <div class="container">
      <p>         </p>
      <h1 style="font-size:46px" align="center"  >&nbsp;</h1>
      <h1 style="font-size:46px" align="center"  >&nbsp;</h1>
      <h1 style="font-size:46px" align="center"  >ACES</h1>
      <h4 align="center"> Automated Code Evaluation System</h4>
      <p></p>
      <h6 align="left">AMRITA SCHOOL OF ENGINEERING</h6>
      <h6 align="left" >COIMBATORE <small></h6>
    <!-- Forms
================================================== -->
<section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tests Available</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="staff_home.php" method="post" enctype="multipart/form-data">
        <fieldset>
         

<?php

if(isset($_POST['submit']))
{   if(!isset($_POST['sel'])) {echo 'You need to select a test.'; exit;}
   $selected=$_POST['sel'];
   $array=array();
$auth->connect();
$query=mysql_query("SELECT start_date,start_time,duration FROM test WHERE test_id='$selected'");    // make changes
if(!$query) {echo 'error'; exit; }
while($row=mysql_fetch_array($query))
{
   $date=$row['start_date'];
   $time=$row['start_time'];
   $duration=$row['duration'];
}

//echo $duration."<br/>";


//echo 'Test_start  :'.$beg; ?>

<?php
  $details=array();
  array_push($details,$selected);
   $r=mysql_query("SELECT * FROM test WHERE test_id='$selected'");
   if(!$r) { echo 'error'; exit;}
  // echo 'TEST DETAILS:'; ?>  <?php
  
   while($row=mysql_fetch_array($r))
      {   
		 $title=$row['title'];
         //echo 'Title: '.$row['title'];   
         $duration=$row['duration'];
        // echo 'Duration :'.$row['duration'] ; 
         $start=$row['start_date'];
        // echo 'Start Date :'.$row['start_date'];
      }
      
    ?>
    <br/>
     <legend> <?php echo $title?> </legend>
           <label>Start Time &nbsp;:<?php echo $time;?></label>
           <label>Start Date &nbsp;:<?php echo $start;?></label>
           <label>Duration &nbsp;:<?php echo $duration;?></label>
         
         <p>
    <?php
   $r=mysql_query("SELECT ques_id FROM test_feed WHERE test_id='$selected'");
   if(!$r) { echo 'error'; exit;}
   while($row=mysql_fetch_array($r))
      {
          array_push($array,$row['ques_id']);
          array_push($details,$row['ques_id']);
      }
   $num=count($array);
  $count1=1;
   
   for($i=0;$i<$num;$i++)
      {   $j=$i+1;
           $r=mysql_query("SELECT * FROM ques_pool WHERE ques_id='$array[$i]'");
           if(!$r) {echo 'error' ; exit; }
           while($row=mysql_fetch_array($r))
                 {
                 ?>
                 <br/>
                 <label> Question <?php echo $j ?></label><div control="label"> <label align='right'> Marks  <?php echo $row['max_marks'] ?> Neg Marks  <?php echo $row['neg_marks'] ?></label></div> <label> <?php echo $row['ques'] ?> </label><br/>
                   <?php
                   $r1=mysql_query("SELECT * FROM option_feed WHERE ques_id='$row[ques_id]'");
                    if(!$r1) {echo 'error' ; exit; }
                    while($row1=mysql_fetch_array($r1))
                          {
                          ?>
                          <input type="radio" name="<?php echo $count1 ?>" value="<?php echo $row1['option_no']?>"/> <?php echo $row1['option1']?> 
                          <br />
                          <?php
                          
                          }
                          ?>
                          </p>
                     
                     <?php
                     
$count1++;                   
                  }
          
            }
}
$_SESSION['det']=implode(',',$details);
?>

<div class="form-actions">
            <input type="submit" class="btn btn-primary" name="submit" value="Back"/>
            
          </div>

        </fieldset>
      </form>
    </div>
  </div>

</section>
   <!-- Footer
      ================================================== -->
      <hr>

  <footer id="footer">
        <p class="pull-right"><a href="#">Back to top</a></p>
    <div class="links"></div>
        Made by <a href="http://www.amrita.edu">Amrita</a>. Contact him <a href="mailto:amrita.edu">hello@admin_asec</a>.<br/>
    Based on <a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>. Icons from <a target="_blank" href="http://glyphicons.com/">Glyphicons</a>. Web fonts from <a target="_blank" href="http://www.google.com/webfonts">Google</a>.</p>
    </footer>
  </body>
</html>
<?php
}
}
?>
