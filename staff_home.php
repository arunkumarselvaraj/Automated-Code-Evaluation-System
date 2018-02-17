<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
require_once ('Auth_staff.php');
session_start();
$auth = new Auth_staff();
if (!isset($_SESSION['user_id'])) 
{
	//Not logged in, send to login page.
	header( 'Location:login.php' );
}
else 
{
	//Check we have the right user
	$logged_in = $auth->checkSession();
	
	if(empty($logged_in)){
		//Bad session, ask to login
		$auth->logout();
		header( 'Location:login.php' );
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
        
        
           <li class="dropdown" id="score-menu">
             <a class="dropdown-toggle" data-toggle="" href="#"> Student Score report <b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/staff_view_score_code.php">Code</a></li>
              <li><a  href="/staff_select_tes.php">MCQs</a></li>
              <li><a  href="/staff_view_score.php">Query</a></li>
                       
              </ul>
              </li>

          
     
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Welcome Staff</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" method="post" action="preview_test1.php" enctype="multipart/form-data">
        <fieldset>
           <legend> Staff home</legend>
           <div class="control-group">
            <label class="control-label" >MCQTests :</label>
             <div class="controls">
             <br/>

<?php
$array=array();
//$db = pg_connect("host=localhost port=5432 dbname=acesdb   user=aces_user password=steamengine");
//if(!$db) echo 'error in connection';
$auth->connect();
$res=mysql_query("SELECT test_id FROM test") or die("sdfcd".mysql_error());   //change
if(!$res) { echo 'error'; exit;}
$i=0;
while($row=mysql_fetch_array($res))
{  array_push($array,$row['test_id']);  
?>
<input type="radio" name="sel" value="<?php echo $array[$i]?>"/><?php echo $row['test_id']?><br/>
<?
$i++;
}

if($i==0)
{
?> <label class="control-label" >No tests created.</label>
 
  
<?php
}
else
{?>            

  </div>
            </div>
         
            <div class="form-actions">
             <input type="submit" class="btn btn-primary" name="submit" value="View Test"/>
            
          </div>
        </fieldset>
      </form>
    </div>
  </div>
 <?php
 }
 ?>


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
}}
?>
