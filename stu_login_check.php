
<html>
<body>
<head>
 <title>ACES : HOME</title>
    <!-- Include the bootstrap stylesheets -->
    <link rel="stylesheet" href="bootstrapnew.css"/>
  
 
        </head>

 <?php
  error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'Auth_stu.php';
  session_start();
  $auth=new Auth_stu();
  if( !$auth->login($_POST['login'],$_POST['password']))
   
    {
   
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
          <li><a id="swatch-link" href="/#gallery">Gallery</a></li>
         
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
        <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" method="POST" enctype="multipart/form-data" >
        <fieldset>
    <legend>Log in</legend>
	 <label class="error">Wrong ID or password. Enter Again.</label>	
			
			<button type="submit" formaction="login.php">Try Again</button>

			<br />
			<br />
			
			<legend> Access Problem </legend>
			
			<a class="a" href="http://www.amrita.edu/"> Cant access my account</a>
			<br />
			<a class="b" href="/boottry.php"> Create an account</a>
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
 <?php
}
else
{
   header('Location: student_home.php');
}
?>
</body>
</html>
