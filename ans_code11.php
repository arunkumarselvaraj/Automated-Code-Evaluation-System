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
       <a class="brand" href="C:\Users\sowmya\Desktop\demo\boot.html">AMRITA</a>
       <div class="nav-collapse" id="main-menu">
        <ul class="nav" id="main-menu-left">
          <li><a onclick="pageTracker._link(this.href); return false;" href="http://news.bootswatch.com">News</a></li>
          <li><a id="swatch-link" href="gallery.html">Gallery</a></li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
          <li><a rel="tooltip" href="http://www.amrita.edu/">Login <i class="icon-share-alt"></i></a></li>
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
      <p>........................................................................................................................................................................................................................................</p>
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
      <form class="form-horizontal well" action="ans_code.php" method="post" enctype="multipart/form-data">
        <fieldset>
          
          <div class="control-group">
            
              <p>
     <?php
if(isset($_POST['submit']))
{

	include 'f_resp1_bk.php';
	if(($_SESSION['iter']+1)==$_SESSION['no_of_ques'])
	{
		
$scores_fetch=mysql_query("select score from each_prob_score where test_id='$_SESSION[test_id]' and stu_id='$_SESSION[user_id]'");

while($score = mysql_fetch_array ($scores_fetch))
{
	$score_avg += $score['score'];
}

$score_avg = $score_avg/$_SESSION['no_of_ques'];

mysql_query("update user_gradebook_code set score_percentage='$score_avg' where test_id='$_SESSION[test_id]' and stu_id='$_SESSION[user_id]' ");
	}
	

echo $_SESSION['iter'];
++$_SESSION['iter'];
}
?>
<?php if(($_SESSION['iter']+1)!=$_SESSION['no_of_ques'])
{
?>
<div class="form-actions">
            <button type="submit" class="btn btn-primary" name="submit">NEXT</button>
<?php }?>
              </p>
            </div>
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
