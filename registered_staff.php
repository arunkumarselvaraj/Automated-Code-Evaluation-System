<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'Auth_staff.php';
session_start();
$auth=new Auth_staff();
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

<?php
echo $_POST['password']."<br>".$_POST['staff_id']."<br>".$_POST['name']."<br>".$_POST['address']."<br>".$_POST['contact']."<br>".
$_POST['department']."<br>".$_POST['gender']."<br>".$_POST['designation']."<br>".$_POST['dob'];
if(empty($_POST['password'])|| empty($_POST['staff_id']) || empty($_POST['name'])|| empty($_POST['address']) || empty($_POST['contact'])|| empty($_POST['department'])|| empty($_POST['gender'])|| empty($_POST['designation']) || empty ($_POST['dob']))
{
?>

  <section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Re-try</h1>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well">
        <fieldset>
          <legend >Looks like there was a problem</legend>
          <div class="control-group">
    <?php  echo 'Some mandatory fields are missing.'; ?>
  <br />
  <a class="a" href="/register_staff.php"> Try again </a>
  <?php
  exit;
}

if( $_POST['repassword']!=$_POST['password'])
{
  ?>
  <section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Re-try</h1>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well">
        <fieldset>
          <legend >Looks like there was a problem</legend>
          <div class="control-group">
    <?php  echo 'Passwords do not match.'; ?>
  <br />
  <a class="a" href="/register_staff.php"> Try again </a>
  <?php
  exit;
}

if( strlen($_POST['repassword']) <5)
{
   ?>
  <section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Re-try</h1>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well">
        <fieldset>
          <legend >Looks like there was a problem</legend>
          <div class="control-group">
    <?php  echo 'Password length less than 5.'; ?>
  <br />
  <a class="a" href="/register_staff.php"> Try again </a>
  <?php
  exit;
}
//$data=file_get_contents($_POST[photo]);$reg_id, $password, $address,$designation,$dob,$dept,$name,$con,$gender
$res=$auth->createUser($_POST['staff_id'],$_POST['password'],$_POST['address'],$_POST['designation'],$_POST['dob'],$_POST['department'],$_POST['name'],$_POST['contact'],$_POST['gender']);


if($res) 
{
	session_unset();
	session_destroy();
?>
<section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Congratulations!</h1>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well">
        <fieldset>
          <legend >Welcome to ACES</legend>
          <div class="control-group">
          <label>Login to complete the registration process.</label>
              <a href="/login.php" > Click here to Login </a>  
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
<?php
exit;
}

else 
{
echo 'picture problem';
?>
<section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Re-try</h1>
  </div>
  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" method="POST" >
        <fieldset>
          <legend >We have encountered an error.</legend>
          <div class="control-group">
          <label>Looks like we have a problem.</label>
              <a href="/register_staff.php" > Try again. </a>  
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
 exit;
 }
 ?>    
  </body>
</html>
