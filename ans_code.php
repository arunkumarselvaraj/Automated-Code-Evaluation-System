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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code Submission</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="ans_code_response.php" method="post" enctype="multipart/form-data">
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="textarea">Question :</label>
            <div class="controls">
              <p>
             <?php session_start();

$con = mysql_connect('localhost','root','mysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("aces", $con) or die('db con faild');


if(isset($_POST['next']))
{
echo $_SESSION['iter'];
++$_SESSION['iter'];
}


echo "<br> Question <br>";
$p_id_temp = $_SESSION['ARR'][$_SESSION['iter']];
echo $p_id_temp;
echo $p_id_temp;
$fetch_ques = mysql_result(mysql_query("select question from code_problem_pool where prob_id='$p_id_temp'"),0); 
echo "---> ".$fetch_ques;?>   
              </p>
            </div>
          </div>
          
           
              <div class="control-group">
            <label class="control-label" for="i03">Language :</label>               <div class="controls">
           <select name="drop" size="1" id="select">
                <option value=1>C</option>
                <option value=2>C++</option>
                <option value=3>Java</option>
              </select>
             </div>     
            </div>
            
             <div class="control-group">
            <label class="control-label" for="fileInput">Upload Code :</label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="file" type="file">
            </div>
          </div>         
            
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" name="submit">Submit code</button>
<?php 



 ?>

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
