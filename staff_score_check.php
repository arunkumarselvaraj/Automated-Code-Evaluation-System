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
          <li><a onclick="pageTracker._link(this.href); return false;" href="http://news.bootswatch.com">News</a></li>
         
         
              <li class="dropdown" id="test-menu">
             <a class="dropdown-toggle" data-toggle="" href="#"> New Test <b class="caret"></b></a>
             <ul id="take_test" class="dropdown-toggle" >
              <li><a  href="/output_test.php">Test Code</a></li>
              <li><a  href="/mcq_test.php">MCQs</a></li>
              <li><a  href="/ques_setter.php">Test Query</a></li>
                       
              </ul>
            </li>   
            </ul>
          </li>
        
        </ul>
        <ul class="nav pull-right" id="main-menu-right">
          <Li>  <form class="navbar-search pull-left">
          
            <input type="text" class="search-query span2" placeholder="Search">
          </form></Li>
          <li><a rel="tooltip" href="#"><?php echo date("d.m.Y") ;?> <i class="icon-share-alt"></i></a></li>
          <!li><!a rel="tooltip" href="#"Hello <?php echo $_POST[$name]; ?> <!i class="icon-share-alt"><!/i><!/a><!/li>
           
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
      <h6 align="left">AMRITA SCHOOL OF ENGINEERING</h6>
      <h6 align="left" >COIMBATORE <small></h6>
    <!-- Forms
================================================== -->
<section id="forms">
  <div class="page-header">
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; View Scores</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="staff_get_score.php" method="post" enctype="multipart/form-data">
        <fieldset>

			<label for="login">Test-ID</label>
			<input type="text" id="test_id" name="test_id"/>
			<div class="clear"></div>
			<br />
			
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="View"/>	
				
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
