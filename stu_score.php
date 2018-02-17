<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ('Auth_stu.php');
session_start();
$auth = new Auth_stu();
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
          <li><a onclick="pageTracker._link(this.href); return false;" href="http://news.bootswatch.com">News</a></li>
          <li class="dropdown" id="score-menu">
             <a class="dropdown-toggle" data-toggle="" href="#">View Scores<b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/code_score.php">Code</a></li>
              <li><a  href="/stu_score.php">MCQs</a></li>
              <li><a  href="/query_score.php">Query</a></li>
        </ul>
          </li>  
               
          <li class="dropdown" id="test-menu">
             <a class="dropdown-toggle" data-toggle="" href="#">Test Offered <b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/take_test_code.php">Test Code</a></li>
              <li><a  href="/select_test.php">MCQs</a></li>
              <li><a  href="/take_test_sql.php">Test Query</a></li>
        </ul>
          </li>  
              
            </ul>
          </li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="#">Welcome<?php  echo $_SESSION['name'] ;?> <i class="icon-share-alt"></i></a></li>
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
      <form class="form-horizontal well" action="student_home.php" method="post" enctype="multipart/form-data">
        <fieldset>
           <legend> Gradebook</legend>
        <table class="table">
           <tr>
           <th>Test_ID</th>
           <th>Your score</th>
           </tr>
<?php
 $auth->connect();
 $res=mysql_query("select * from  stu,score where score.stu_id=stu.id and score.stu_id='$_SESSION[user_id]' ");
 while($row=mysql_fetch_assoc($res))
  {
	  ?>
	   <tr>
	   <td> <?php echo $row['test_id']?> </td>
	   <td> <?php echo $row['stu_score']?></td>
	   </tr>
<?php
}
?>
</table>
 
<div class="form-actions">
            <input type="submit" class="btn btn-primary" name="submit" value="Back to home"/>
            
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
