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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code Submission Response</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="ans_code.php">
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="textarea">RULEs</label>
            <div class="controls">
              <p>
           <?php session_start();

$con = mysql_connect('localhost','root','mysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("aces", $con) or die('db con faild');

  mysql_query("insert into user_gradebook_code (stu_id,test_id) values ( '$_SESSION[user_id]','$_POST[test]')") or die("sdadadsadadassdada*".mysql_error());


$query = mysql_query("select prob_id from test_prob where test_id='$_POST[test]'");
$j=0;
$num = mysql_num_rows($query);

$_SESSION['test_id']=$_POST['test'];
$_SESSION['no_of_ques']=$num;
$_SESSION['iter']=0;

echo 'Rules go here...!';


while($info = mysql_fetch_array($query))
{
$_SESSION['ARR'][$j] = $info['prob_id'];

$j++;
}
for($i=0;$i<$num;$i++)
{
echo $_SESSION['ARR'][$i];
}

?>     
              </p>
            </div>
          </div>
          
           
          
        
            
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Start test</button>
            <button type="reset" class="btn">Cancel</button>
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
        <p class="pull-right"><a href="boot.html">Back to top</a></p>
    <div class="links"></div>
        Made by <a href="http://www.amrita.edu">Amrita</a>. Contact him <a href="mailto:amrita.edu">hello@admin_asec</a>.<br/>
    Based on <a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>. Icons from <a target="_blank" href="http://glyphicons.com/">Glyphicons</a>. Web fonts from <a target="_blank" href="http://www.google.com/webfonts">Google</a>.</p>
    </footer>
  </body>
</html>
