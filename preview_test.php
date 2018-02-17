<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
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
<! A preview of what the staff's test>
<html>
  <head>
    <title>ACES : HOME</title>
    <!-- Include the bootstrap stylesheets -->
    <link rel="stylesheet" href="bootstrapnew.css"
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
        <ul class="drop" id="main-menu-left">
        
          <li><a id="swatch-link" href="/staff_mcq_score.php" >Scores Mcq</a></li>
          

          
     
             <li class="dropdown" id="test-menu">
             <a class="dropdown-toggle" data-toggle="" href="#"> Add Question <b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/Code_Ques_set.php">Test Code</a></li>
              <li><a  href="/enter_pool.php">MCQs</a></li>
              <li><a  href="/Query_ques_set.php">Test Query</a></li>
                       
              </ul>
              </li>
               <li class="dropdown" id="test-menu">
             <a class="dropdown-toggle" data-toggle="" href="#"> New Test <b class="caret"></b></a>
               <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/make_test.php">Test Code</a></li>
              <li><a  href="/test_maker.php">MCQs</a></li>
		<li><a  href="/make_test_sql.php">Test Query</a></li>
                       
              </ul>
            </li>  
           
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
         
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="#">Welcome <?php echo $_SESSION['name']; ?> <i class="icon-share-alt"></i></a></li>
            
           <li><a rel="tooltip" href="/logout_staff.php">Logout <i class="icon-share-alt"></i></a></li>
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
      <h6 align="left">AMRITA SHOOL OF ENGINEERING</h6>
      <h6 align="left" >COIMBATORE <small></h6>
    <!-- Forms
================================================== -->

<section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Test Preview</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="create_test.php" method="POST">
        <fieldset>
         
          <?php
            
 $auth->connect();
           
           //$query = "INSERT INTO test(test_id,title,start_date,start_time,duration) VALUES ('$_POST[test_id]','$_POST[title]','$_POST[start_date]','$_POST[start_time]','$_POST[duration]')";
//$res=pg_query($db,$query);
//if(!$res) {echo ' This test_id already exists'; exit;}
        $num=1;
        $op=1;
        
  //     session_start();
       // $_SESSION['qno'];
       $array=array();
       array_push($array,$_POST['test_id']);
       array_push($array,$_POST['title'],$_POST['start_date'],$_POST['start_time'],$_POST['duration']);
        ?>
        <legend> <?php echo $_POST['title']?> 
         <p> <label> Duration: <?php echo $_POST['duration']?> </label> </p></legend>
        <?php
   $ques=array();
   $r=mysql_query("SELECT ques_id FROM ques_pool");
   while($row=mysql_fetch_array($r))
   {array_push($ques,$row['ques_id']); }
   if(isset($_POST['submit']))
     { 
        for($j=0;$j<count($ques);$j++)
         {         
           if(isset($_POST[$ques[$j]]))
             { 
               $ch1=$_POST[$ques[$j]];
               if($ch1==$ques[$j])
                  {   
                     array_push($array,$ch1);
                     $count=0;
                    $r=mysql_query("SELECT * FROM ques_pool WHERE ques_id='$ch1'");
                    if(!$r) {echo 'error' ; exit; }
                    while($row=mysql_fetch_array($r))
                     { $count++;
                       ?>
                     <br/>
                     <label> Question <?php echo $num." details: "?> Marks  <?php echo $row['max_marks'] ?> 
                      Neg Marks  <?php echo $row['neg_marks'] ?> <br/> <?php echo $row['ques'] ?> </label>
                     <?php
                        $r1=mysql_query("SELECT * FROM option_feed WHERE ques_id='$row[ques_id]'");
                        if(!$r1) {echo 'error' ; exit; }
                        ?>
                        <p>
                        <?php
                        while($row1=mysql_fetch_array($r1))
                          {
                          ?>
                          <input type="radio" name="<?php echo $count?>" value="<?php echo $row1['option_no'];?>"/> <?php echo $row1['option1']?> 
                          <br />
                          <?php
                          $op++; 
                          }
                          ?>
                          </p>
                     
                     <?php
                     
                    $num++;  
                     }
                  }
             }
         }
   }    
            
$_SESSION['qno']=implode(",",$array);
 ?>       
        <div class="form-actions">
            <input type="submit" class="btn btn-primary" name="submit" value="Create Test"/>
            <button type="reset" class="btn" formaction="test_maker.php" >Edit</button>
          </div>
        </fieldset>
        </div>
        </div>   
         
  
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
