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
        <ul class="drop" id="main-menu-left">
        
          <li><a id="swatch-link" href="/staff_select_test.php" >Scores Mcq</a></li>
          

          
     
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Test summary</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="response.php" method="post" enctype="multipart/form-data">
        <fieldset>
			 <legend>Scores</legend>
         <?php 
 //error_reporting(E_ALL);
 //ini_set('display_errors','1');
 $auth-> connect();
  $correctans=array();
 $add=array();
 $sub=array();
 $name=$_SESSION['name'];
 $test=$_POST['sel'];
 $query= "SELECT max(stu_score) AS max FROM score WHERE test_id='$test'";
 $r=mysql_query ($query);
 while($row=mysql_fetch_array($r))
   {
	   $highest=$row['max'];
	}
  $query= "SELECT min(stu_score) AS min FROM score WHERE test_id='$test'";
 $r=mysql_query ($query);
 while($row=mysql_fetch_array($r))
   {
	   $lowest=$row['min'];
	} 
   $query= "SELECT avg(stu_score) AS avg FROM score WHERE test_id='$test'";
 $r=mysql_query ($query);
 while($row=mysql_fetch_array($r))
   {
	   $average=$row['avg'];
	   }
  $i=mysql_num_rows($r);
   if($i==0)
  {
    ?> <legend>Test has not been taken by anyone </legend>
  <?php
  }
  else
   {   
  ?>
 
 <table class="table">
 <tr>
 <th>Student_ID</th>
 <th>Student Name</th>
 <th>Score        </th>
 </tr> 
 <?php
   $query= "SELECT * FROM score,stu WHERE test_id='$test' and stu.id=score.stu_id";
   $r=mysql_query($query);
  
 while($row=mysql_fetch_array($r))
   { $i++;
 ?>
    <tr>
    <td><?php echo $row['stu_id']?></td>
    <td> <?php echo $row['name']?></td>
    <td><?php echo $row['stu_score']?></td>
    </tr>
   <?php
   
   }
   ?>
  </table>
  <br/>
   <legend>Test Highest: <?php echo $highest?> </legend>
   <legend>Test Lowest: <?php echo $lowest?> </legend>
   <legend>Test Average: <?php echo $average?> </legend>        
    <?php
  }
    ?>       
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
