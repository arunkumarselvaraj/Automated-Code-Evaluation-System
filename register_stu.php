<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start(); 

?>
<!DOCTYPE html>
<html>
  <head>
    <title>ACES : HOME</title>
    <!-- Include the bootstrap stylesheets -->
    <link rel="stylesheet" href="bootstrapnew.css"/>
  
 
        </head>
  <body>
  <?php  ?>
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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration Form</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="registered_stu.php" method="POST">
        <fieldset>
          <legend >Enter the following details
          <label>All fields are mandatory</label></legend>
          <div class="control-group">
            <label class="control-label" for="input01">Name</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="name" id="i01">
              <p class="help-block">Enter your fullname(ID card).</p>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="i02">Registration Number</label>      <div class="controls">
              <p>
                <input type="text" class="input-xlarge" name="stu_id" id="i01">
              </p>
            </div>
            </div>
             <div class="control-group">
            <label class="control-label" for="input01">Password</label>
            <div class="controls">
              <input type="password" class="input-xlarge" name="password" id="i01">
             
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="input01">Re-type Password</label>
            <div class="controls">
              <input type="password" class="input-xlarge" name="repassword" id="i01">
             
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="input01">Department</label>
            <div class="controls">
              <input type="text" class="input-xlarge" name="department" id="i01">
              
            </div>
          </div>
             <div class="control-group">
            <label class="control-label" for="i02">Gender</label>      <div class="controls">
             <select name="gender" size="1" id="select">
               <option>F</option>
               <option>M</option>
             </select>
            </div>
            </div>
         
            <div class="control-group">
            <label class="control-label" for="select01">Date of Birth (dd-mmm-yyyy)</label>
            <div class="controls" >
               <p>
                <input type="text" class="input-xlarge" name="dob" id="i01">
              </p>
            </div>
            </div>
           <div class="control-group">
            <label class="control-label" for="i02">Batch</label>      <div class="controls">
              <p>
                <input type="text" class="input-xlarge" name="batch" id="i01">
              </p>
            </div>
            </div>
         
         
          <div class="control-group">
            <label class="control-label" for="textarea">Address</label>
            <div class="controls">
              <p>
                <textarea class="input-xlarge" id="textarea" name="address" rows="3"></textarea>
              </p>
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="i02">Contact</label>      <div class="controls">
              <p>
                <input type="text" class="input-xlarge" name="contact" id="i01">
              </p>
            </div>
            </div>
         
          <div class="form-actions">
            <input name="check" type="submit" value="Save changes" />
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
        <p class="pull-right"><a href="#">Back to top</a></p>
    <div class="links"></div>
        Made by <a href="http://www.amrita.edu">Amrita</a>. Contact him <a href="mailto:amrita.edu">hello@admin_asec</a>.<br/>
    Based on <a target="_blank" href="http://twitter.github.com/bootstrap/">Bootstrap</a>. Icons from <a target="_blank" href="http://glyphicons.com/">Glyphicons</a>. Web fonts from <a target="_blank" href="http://www.google.com/webfonts">Google</a>.</p>
    </footer>
        

 </body>
</html>

