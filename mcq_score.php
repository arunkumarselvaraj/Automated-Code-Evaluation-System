<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
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
  <?php 
 //error_reporting(E_ALL);
 //ini_set('display_errors','1');
 $auth-> connect();
  $correctans=array();
 $add=array();
 $sub=array();
 $name=$_SESSION['name'];
 $query= "SELECT * FROM stu WHERE id='$_SESSION[user_id]'";
 $r=mysql_query ($query);
 while($row=mysql_fetch_array($r))
  {
	   $stu=$row['stu_id'];
  }
 echo $_SESSION['det'];
 $details=explode(',',$_SESSION['det']);
 echo $details[0];
 $tid=$details[0];
 for($i=1;$i<count($details);$i++)
  {
     $res=mysql_query("SELECT * FROM ques_pool WHERE ques_id='$details[$i]'");
     while($row=mysql_fetch_array($res))
     {
        array_push($correctans,$row['ques_id'].$row['ans']);
        array_push($add,$row['max_marks']);
        array_push($sub,$row['neg_marks']);
     }
  }
 
 
 $score=0;
 for($i=1;$i<count($details);$i++)
 {  $j=$i-1;
  //  echo 'correct_ans='.$correctans[$j]; ?> <br />
    <?php
    //echo 'your_ans='.$_POST[$i]; ?> <br /> <?php
    
    //$res=pg_query("SELECT * FROM option_feed WHERE ques_id='$details[$i]'");
    //while($row=pg_fetch_assoc($res))
     //{
        if($_POST[$i]==$correctans[$j] )
          {     
               $score+=$add[$j];
               continue;
          }
       else if( isset($_POST[$i]))
         {
              $score-=$sub[$j];
           
         }
     //}
     
 }
 $q="INSERT INTO score VALUES('$_SESSION[user_id]','$details[0]','$score')";
 $ins=mysql_query($q) or die("cant insert");
 if(!$ins) "update failed";
 ?>

   
  
  
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
        <ul class="nav" id="main-menu-left">
          <li><a onclick="pageTracker._link(this.href); return false;" href="http://news.bootswatch.com">News</a></li>
          <li><a id="swatch-link" href="/stu_score_list.php">Scores</a></li>
          <li><a id="score-check" href="/select_test.php">Test Offered</a></li>
              
            </ul>
          </li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          
          
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tests Available</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="response.php" method="post" enctype="multipart/form-data">
        <fieldset>
           <table class="table">
<tr>
<th>Sno</th>
<th>Test Id</th>
<th> Your Score </th>

</tr>
<tr>
<td><?php echo $stu?></td>
<td><?php echo $details[0]?></a></td>
<td><?php echo $score?> </td>
</tr>
</table> 
           
           
</fieldset>
      </form>
    </div>
  </div>

</section>
   <!-- Footer
      ================================================== -->
      <hr>

  <footer id="footer">
        <p class="pull-right"><a href="boot.html">Back to top</a></p>
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
