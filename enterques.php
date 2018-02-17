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
    <link rel="stylesheet" href="bootstrapnew.css"/>
  
 
        </head>
  <body>
  
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
  
  
  
  <section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Insert into question pool</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="enterques.php" method="POST">
        <fieldset>
          <legend >Feedback :</legend>
          
         <?php
//error_reporting(E_ALL);
//ini_set('display_errors','1');
//session_start();
$ques=explode(',',$_SESSION['ques_pool']);
$op=explode(',',$_SESSION['option_feed']);
$ch=0;
/*for($i=0;$i<count($op);$i++)
{
   if(isset($_POST[$op[$i]]))
    {
       $ch=$op[$i];
       array_push($correctans,$ch);
    }
}
$cor=implode(',',$correctans);
echo $cor;
$ins= '{'.$cor.'}';
echo $ins;*/
$auth->connect();
$query1 = "INSERT INTO ques_pool(ques_id,ques,max_marks,neg_marks,ans) VALUES ('$ques[0]','$ques[1]','$ques[2]','$ques[3]','$_POST[ans]')";
$query = mysql_query($query1) or die("The question ID you entered is already entered. Please try another question ID. Sorry for the inconvienience. We are trying to fix this.");
 //array_push($ques_pool,$_POST['ques_id'],$_POST['ques'],$_POST['max_marks'],$_POST['neg_marks']);
if(!$query) {echo 'error'; exit; }
$a=1;
for($i=0;$i<count($op);$i++)
{  $j=$a.$op[$i];
   $q=mysql_query("INSERT INTO option_feed(ques_id,option_no,option1) VALUES ('$ques[0]','$op[$i]','$_POST[$j]')");
   if(!$q) {echo 'error'; exit; }
}


?>

           <label class="control-groups" > Question added to pool.</label>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" formaction="enter_pool.php">Add another question</button>
            <button type="submit" class="btn btn-primary" formaction="test_maker.php">Create test</button>

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
