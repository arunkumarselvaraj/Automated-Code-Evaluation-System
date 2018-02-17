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
          <Li>  
          <form class="navbar-search pull-left">
          <input type="text" class="search-query span2" placeholder="Search">
          </form>
          </Li>
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
        </ul>
       </div>
     </div>
   </div>
 </div>
 
    <div class="container">
    <div class="container">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<h1 style="font-size:46px" align="center"  >ACES</h1>
      <h4 align="center"> Automated Code Evaluation System</h4>
      <p>........................................................................................................................................................................................................................................</p>
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
      <form action="registered_staff.php" method="post" class="form-horizontal well">
        <fieldset>
          <legend >Enter the following details!</legend>
          <div class="control-group">
            <label class="control-label" for="input01">Name</label>
            <div class="controls">
              <input placeholder="Full name as in ID card" type="text" name="name" class="input-xlarge" id="i01">
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label" for="i02">Registration Number</label>     
             <div class="controls">
              <p>
                <input placeholder="Full registration number" type="text" name="staff_id" class="input-xlarge" id="i01">
              </p>
            </div>
            </div>
            
          <div class="control-group">
            <label class="control-label" for="i03">Gender</label>
            <div class="controls">
            <select name="gender" size="1" id="select">
                <option>Female</option>
                <option>Male</option>
            </select>
            </div>     
          </div>
         
         <div class="control-group">
            <label class="control-label" for="i03">Designation</label>     
            <div class="controls">
              <p>
                <input placeholder="Your post!" type="text" name="designation" class="input-xlarge" id="i03">
              </p>
            </div>
         </div>
    
         <div class="control-group">
            <label class="control-label" for="i03">Department</label>     
             <div class="controls">
              <p>
                <input placeholder="Dept" name="department" type="text" class="input-xlarge" id="i03">
              </p>
            </div>
         </div>

         <div class="control-group">
            <label class="control-label" for="i03">Date of Birth</label>  
             <div class="controls">
              <p>
                <input placeholder="DD-MMM-YYYY (Ex: 01-jan-2012)" name="dob" type="text" class="input-xlarge" id="i03">
              </p>
            </div>
         </div>
         
               
          <div class="control-group">
            <label class="control-label" for="textarea">Address</label>
            <div class="controls">
              <p>
                <textarea placeholder="Permanent address along with the pin-code" name="address" class="input-xlarge" id="textarea" rows="3"></textarea>
              </p>
            </div>
          </div>

           <div class="control-group">
            <label class="control-label" for="i03">Contact Number</label>     
             <div class="controls">
              <p>
                <input placeholder="XXXXXXXXXX" type="text" name="contact" class="input-xlarge" id="i03">
              </p>
             </div>
            </div>         
            
           <div class="control-group">
            <label class="control-label" for="i03">Password</label>     
             <div class="controls">
              <p>
                <input placeholder="6 characters minimum" type="password" name="password" class="input-xlarge" id="password1">
              </p>
             </div>
           </div>
            
           <div class="control-group">
            <label class="control-label" for="i03">Confirm Password</label>     
             <div class="controls">
              <p>
                <input placeholder="Confirm password" type="password" name="repassword" class="input-xlarge" id="password2">
              </p>
             </div>
           </div>
       
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save changes</button>
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
