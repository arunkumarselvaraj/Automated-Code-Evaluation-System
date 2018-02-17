<?php

require_once ('Auth_stu.php');
session_start();
$auth = new Auth_stu();
if (!isset($_SESSION['user_id'])) 
{
	die('nogrjig');
	//Not logged in, send to login page.
	//header( 'Location: login.php' );
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code Submission Response</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" method="post" action="test_RULES_SQL.php">
        <fieldset>
          
          <div class="control-group">
            <label class="control-label" for="textarea">Available Tests</label>
            <div class="controls">
              <p>
  		<?php session_start();

$con = mysql_connect('localhost','root','mysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("aces", $con) or die('db con faild');
$_SESSION['i']=0;
//the list that i print here must be convrted to check box or radio button or links
$query = mysql_query("select * from test_pool_sql where test_id not in (select test_id from user_gradebook_Query where stu_id=$_SESSION[user_id]");
//$j = 1;
while($info = mysql_fetch_array($query))
{
echo '<br>'.'('.$info['test_id'].')'.$info['test_name'].'----';
//$j++;
}

?>
              </p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="input01">Choose your test :</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="i01" name="test_id">
             
            </div>
          </div>
                    
        
            
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Go</button>
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
<?php
}
}
?>
