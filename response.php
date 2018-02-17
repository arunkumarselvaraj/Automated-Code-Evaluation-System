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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Response Summary</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well">
        <fieldset>
<?php

if(isset($_POST['submit']))
{
$con = mysql_connect('localhost','root','mysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("aces", $con) or die('db con faild');

$temp_name=mysql_result(mysql_query("select max(pid) from problem_pool"),0);

if(!$temp_name)
$temp_name=0;
$t = $temp_name+1;

$myFile = $t.'.sql';
$ans = $t.'ans'.'.sql';

$f = fopen("/var/www/sql_files/".$ans, 'w') or die("can't open file");
$sData = $_POST[ap];
$sql_filepath_base = "/var/www/sql_files/";
fwrite($f, $sData);
$p= $sql_filepath_base.$myFile;
$a= $sql_filepath_base.$ans;

$fh = fopen("/var/www/sql_files/".$myFile, 'w') or die("can't open file");
$temp_db="use temp_db;";
$stringData = $_POST[instance_id];
$sql_filepath_base = "/var/www/sql_files/";
fwrite($fh, $stringData);
$p= $sql_filepath_base.$myFile;
$query = "insert into problem_pool (question,answer,url) values('$_POST[qp]','$a','$p')";
$c1 = mysql_query($query); //or die('Insertion into prob_pool failed!');
}
$ty = mysql_query("select answer from problem_pool where pid = '$prob_id'");
//echo mysql_result($ty,0);
//echo '<br>';

$q_op = mysql_query("select * from problem_pool where pid='$prob_id'") or die(':('.mysql_error());
//echo 'prob_pool query done:)';
//echo 'here....';
mysql_query("create database templ;") or die('database creation failed!!');

mysql_select_db("templ",$con) or die('db con failure!!');
 
//echo 'Success... ' . $mysqli->host_info . "<br />";
//echo 'Retrieving dumpfile' . "<br />";
//echo "...............".$_SESSION['TRY'];
//echo "......<br>";
//$prob_id = $_SESSION['TRY'];
//$con = mysql_connect('localhost','root','kolam16f');
//if (!$con)
  {
  //die('Could not connect: ' . mysql_error());
  }



$mysqli = new mysqli('127.0.0.1', 'root', 'mysql','templ');
 
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
$testquery = $_POST['ap'];
//echo $testquery."____";

$sql = file_get_contents($p);
if (!$sql){
	die ('Error opening file');
}
//echo $sql;
//echo '<br>'.$sql.'<br>'
$instance = mysqli_multi_query($mysqli,$sql);// or die('wrong');
$test = mysql_query($testquery);// or die('wronggg');
mysql_query("drop database templ;");
if(($instance)&&($test)&&($c1))
{
 echo '<h1>Question Submitted  </h1>';
}
else
{
echo '<p>Query given was wrong! Please try again</p>';
}
?>

       
        
<p><a href="login.php">Go back home </a>    </p>
      </form>
    </div>
  </div>

</section>
   <!-- Footer
      ================================================== -->
      <hr>

  <footer id="footer">
        <p class="pull-right"><a href="mypage.html">Back to top</a></p>
    <div class="links"></div>
        Made by <a href="http://www.amrita.edu">Amrita</a>. Contact <a href="mailto:amrita.edu">hello@admin_asec</a>.<br/>
    Based on <a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>. Icons from <a target="_blank" href="http://glyphicons.com/">Glyphicons</a>
    
    </footer>
  </body>
</html>

<?php }}?>
