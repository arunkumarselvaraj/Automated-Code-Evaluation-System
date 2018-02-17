<?php

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
			<li><a rel="tooltip" href="/staff_home.php">Home <i class="icon-share-alt"></i></a></li>
          <li><a onclick="pageTracker._link(this.href); return false;" href="http://news.bootswatch.com">News</a></li>
          <li><a id="swatch-link" href="/staff_score_check.php" >Scores</a></li>
          
     
           
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <li><a rel="tooltip" href="#">Welcome <?php $name=$_POST['login']; echo $_POST['login'] ; ?> <i class="icon-share-alt"></i></a></li>
            
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
      <h6 align="left">AMRITA SHOOL OF ENGINEERING</h6>
      <h6 align="left" >COIMBATORE <small></h6>
  
  
  
  <section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Insert into question pool</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="confirm.php" method="POST">
        <fieldset>
          <legend >Enter the following details</legend>
          
          <div class="control-group">
            <label class="control-label" for="input01">Question ID :</label>
            <div class="controls">
              <input type="text"   name="ques_id" >
            </div>
          </div>
          
         <div class="control-group">
            <label class="control-label" for="input01">Question :</label>
            <div class="controls">
            	<textarea name="ques" > </textarea>
            </div>
          </div>
          
            
          <div class="control-group">
            <label class="control-label" for="input01">Maximum marks :</label>
            <div class="controls">
              <input type="text"   name="max_marks" >
            </div>
          </div>
          
            <div class="control-group">
            <label class="control-label" for="input01">Negative marks :</label>
            <div class="controls">
              <input type="text"   name="neg_marks" >
            </div>
          </div>
          
           <div class="control-group">
            <label class="control-label" for="input01"> Enter number of options you want(max 5)</label>
            <div class="controls">
              <input type="text"   name="option_number" >
            </div>
          </div>

         
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save & Continue</button>
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
