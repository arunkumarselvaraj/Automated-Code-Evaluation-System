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
          <li><a id="swatch-link" href="/stu_score.php">Scores</a></li>
          <li class="dropdown" id="test-menu">
             <a class="dropdown-toggle" data-toggle="" href="#">Test Offered <b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/stu_test.php">Test Code</a></li>
              <li><a  href="/student_mcq.php">MCQs</a></li>
              <li><a  href="/stu_test.php">Test Query</a></li>
                       
              </ul>
            </li>  
              
            </ul>
          </li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="#">Welcome <?php echo $_POST['login']; ?> <i class="icon-share-alt"></i></a></li>
          
           <li><a rel="tooltip" href="/logout.php">Logout <i class="icon-share-alt"></i></a></li>
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="response.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend> Student Home </legend>
           
</fieldset>
      <h2> Query Submitted  </h2>
       <?php     if(($_SESSION['iter']+1)<$_SESSION['no_of_ques'])
{
echo '
<input type="submit" class="btn btn-primary" name="next" value="Next" />';
}?>
    <p><a href = "/query_score.php">See Scores</a></p>
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


 
//echo 'Success... ' . $mysqli->host_info . "<br />";
//echo 'Retrieving dumpfile' . "<br />";
//echo "...............".$_SESSION['TRY'];
//echo "......<br>";
$prob_id = $_SESSION['ARR'][$_SESSION['iter']];
echo $_SESSION['iter'].':----------------------:'.$prob_id;
$con = mysql_connect('localhost','root','mysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("aces", $con) or die('db con faild');

$qry =mysql_query("SHOW TABLES;");
//echo "<br /> all tables deleted <br />";

$ty = mysql_query("select answer from problem_pool where pid = '$prob_id'");
//echo mysql_result($ty,0);
//echo '<br>';

$q_op = mysql_query("select * from problem_pool where pid='$prob_id'") or die(':('.mysql_error());
//echo 'prob_pool query done:)';
//echo 'here....';
$username = $_SESSION['name'];
mysql_query("drop database if exists $username;");
mysql_query("create database $username;") or die('database creation failed!!');

mysql_select_db("$username",$con) or die('db con failure!!');
 
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



$mysqli = new mysqli('127.0.0.1', 'root', 'mysql', $username);
 
if (mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
if(mysql_num_rows($q_op) == 1)
{
$info = mysql_fetch_array($q_op);


$testquery =file_get_contents($info['answer']);
echo $testquery;
/*echo '<br>';
echo ":)".$info['url'].":( :(";
echo  '<br>';*/
}
//echo $testquery;
$sql = file_get_contents($info['url']);
if (!$sql){
	die ('Error opening file');
}


//echo '<br>'.$sql.'<br>';
mysqli_multi_query($mysqli,$sql) or die('wrong');
$t3  = str_replace("("," ",$testquery);
$chars = preg_split('/ /',$t3,-1,PREG_SPLIT_OFFSET_CAPTURE);
//echo '<br>';
//print_r($chars);
//echo '<br>';
mysql_query("start transaction;") or die('transaction failed!!');
mysql_query("savepoint t;") or die('savepoint failed!!');
if($chars[0][0]=='update')
{
$data = $chars[1][0];
$u1 = mysql_query($testquery);
$testquery = "select * from $data;";
//echo 'inside update';
}
else if($chars[0][0]=='insert'||$chars[0][0]=='delete')
{
$data = $chars[2][0];
//echo '.........inside insert';
$u1 = mysql_query($testquery);
$testquery = "select * from $data;";
}
//echo $testquery;

if($chars[0][0] == 'create')
{
//echo 'inside else';
$data = $chars[2][0];
$u1 = mysql_query($testquery);
$testquery = "describe $data";
//echo $testquery;
}
//echo $chars[0][0];
//echo $chars[1][0];
//echo 'nothing here____';
if($chars[0][0] == 'alter')
{
//echo 'i am here!!!___';
$temptab = 'temp';
$table = $chars[2][0]; 
$query = "create table $temptab as select * from $table ";
mysql_query($query);// or die(mysql_error());
$testquery = str_replace($chars[2][0],$temptab,$testquery);
$u1 = mysql_query($testquery) or die(mysql_error());
$testquery = "describe $temptab";
}
//echo $testquery;
$t2=mysql_query($testquery) or die('test query failed!!'.mysql_error());

$num1 = mysql_num_rows($t2);
//echo $num1;
$i=0;
while($info2 = mysql_fetch_array($t2))
{
$j=0;
$t_a[$i] = $info2;
//print_r($t_a[$i]);
//echo '<br>';
$i++;
}

if($chars[0][0]=='create')
{
$table= $chars[2][0];
$dropquery = "drop table $table";
mysql_query($dropquery) or die('drop query failed!!'.mysql_error());
}
else if($chars[0][0]=='alter')
{
$dropquery = "drop table $temptab";
mysql_query($dropquery) or die('drop query failed alter!!'.mysql_error());
//echo 'in place!!_______________';
}

else
{
mysql_query("rollback to savepoint t;") or die('roll back failed!!');
mysql_query("release savepoint t;") or die('release failed!!');

}

$flags=0;
mysql_query("start transaction;") or die('transaction failed!!');
mysql_query("savepoint t;") or die('savepoint failed!!');
$userquery = $_POST['ques'];
echo $userquery.'___';
//echo $userquery;
$u3  = str_replace("("," ",$userquery);
$uchars = preg_split('/ /',$u3,-1,PREG_SPLIT_OFFSET_CAPTURE);
//if($uchars[0][0]!='create'&&$uchars[0][0]!='alter'&&$uchars[0][0]!='drop')
//{
//if($uchars[0][0]!='select')
if($uchars[0][0]=='update')
{
$data = $uchars[1][0];
$u1=mysql_query($userquery);// or die('user query failed!!');
if(!$u1)
{
$flags = 1;
}
$userquery = "select * from $data;";
//echo 'inside update';
}
else if($uchars[0][0]=='insert'||$uchars[0][0]=='delete')
{
$data = $chars[2][0];
$u1=mysql_query($userquery);// or die('user query failed!!');
if(!$u1)
{
$flags = 1;
}
$userquery = "select * from $data;";
//echo 'inside insert';
}
//echo $selectquery;
if($uchars[0][0] == 'create')
{
//echo 'inside else';
$data = $chars[2][0];
$u1=mysql_query($userquery);// or die('user query failed!!');
if(!$u1)
{
$flags = 1;
}
$userquery = "describe $data";
//echo $testquery;
}
if($uchars[0][0] == 'alter')
{
$temptab = 'temp';
$table = $chars[2][0]; 
$query = "create table $temptab as select * from $table ";
mysql_query($query) or die(mysql_error());
$userquery = str_replace($chars[2][0],$temptab,$userquery);
$u1 = mysql_query($userquery);// or die(mysql_error());

if(!$u1)
{
$flags = 1;
}
$userquery = "describe $temptab";
}
//echo $userquery;
$t2=mysql_query($userquery); //or die('select query failed!!');
if(!$t2)
{
$flags = 1;
}
$num2 = mysql_num_rows($t2);
//echo $num2;
$j=0;
while($uinfo2 = mysql_fetch_array($t2))
{

$u_a[$j] = $uinfo2;
//print_r($u_a[$j]);
//echo '<br>';
$j++;
}
$flag=0;
$y=0;
while($y<$num1)
{

$v = array_diff($u_a[$y],$t_a[$y]);
$v1 = array_diff($t_a[$y],$u_a[$y]);
//print_r($v);
if(!(empty($v))||!(empty($v1)))
{
$flag=1;
break;
}
$y++;
}
$result = 0;
if($flag==0&&$flags!=1)
{
$result++;
}
echo $result;


if($uchars[0][0]=='create')
{
$table= $chars[2][0];
$dropquery = "drop table $table";
mysql_query($dropquery) or die('drop query failed!!'.mysql_error());
}
else if($uchars[0][0]=='alter')
{
$dropquery = "drop table $temptab";
mysql_query($dropquery) or die('drop query failed alter!!'.mysql_error());
}

else
{
mysql_query("rollback to savepoint t;") or die('roll back failed!!');
mysql_query("release savepoint t;") or die('release failed!!');

}


mysql_select_db("aces", $con) or die('db con faild');
mysql_query("use aces")or die('here it is!!');
$temp_iter=$_SESSION['ARR'][$_SESSION['iter']];
echo "====".$_SESSION['ARR'][$_SESSION['iter']]."====".$_SESSION['user_id']."====".$_SESSION['test_id']."====";
	mysql_query("insert into each_query_score(stu_id,test_id,prob_id,score) values ('$_SESSION[user_id]','$_SESSION[test_id]','$temp_iter','$result')") or die('aaaa'.mysql_error());
echo 'crossed insert!!!!!!!!!';
		//store score in user_gradebook_coding
	if(($_SESSION['iter']+1)==$_SESSION['no_of_ques'])
	{
		
$scores_fetch=mysql_query("select score from each_query_score where test_id='$_SESSION[test_id]' and stu_id='$_SESSION[user_id]'");
$score_avg=0;
while($score = mysql_fetch_array ($scores_fetch))
{
	$score_avg += $score['score'];
}

$score_avg = $score_avg/$_SESSION['no_of_ques'];
$score_avg *=100;

mysql_query("update user_gradebook_Query set score_percentage=$score_avg where test_id='$_SESSION[test_id]' and stu_id='$_SESSION[user_id]' ");		
	}
	


mysql_query("drop database $username") or die(mysql_error());
$mysqli->close();
?>
<?php
}
}
?>
