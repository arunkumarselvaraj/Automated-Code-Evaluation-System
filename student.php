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
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tests Available</h1>
  </div>

  <div class="row">
    <div class="span10 offset1">
      <form class="form-horizontal well" action="Code_Ques_set.php" method="post" enctype="multipart/form-data">
        
<?php
	if(isset($_POST['submit']))
	{

		$con = mysql_connect('localhost','root','mysql');
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		mysql_select_db("aces", $con) or die('db con faild');
		$target_path = "questionsetter/";  //folder named questionsetter must b there in d /var/www folder//
		$target_path = $target_path . basename( $_FILES['ip_file']['name']); 
		     chmod($_FILES["ip_file"]["tmp_name"],0777);

		 move_uploaded_file($_FILES["ip_file"]["tmp_name"],$target_path);
		      echo "Stored in: " . "questionsetter/" . $_FILES["ip_file"]["name"];
		$path ="questionsetter/" . $_FILES["ip_file"]["name"];
		$fil = $_FILES["ip_file"]["name"];
		echo '<br>';
		$target_path_2 = "questionsetter/";
		$target_path_2 = $target_path_2.basename( $_FILES['op_file']['name']); 
		     chmod($_FILES["op_file"]["tmp_name"],0777);

		 move_uploaded_file($_FILES["op_file"]["tmp_name"],$target_path_2);
		      echo "Stored in: "."questionsetter/".$_FILES["op_file"]["name"];
		$path_2="questionsetter/".$_FILES["op_file"]["name"];
		$fil_2= $_FILES["op_file"]["name"];



 

		$query = "insert into code_problem_pool (question,input_name,input_url,output_url,subject,num_of_lines_per_tc) values('$_POST[id]','$_POST[ip_name]','','','$_POST[subject]','$_POST[nol_tc]')";
		mysql_query($query)or die('Query failure!!!!'.mysql_error());
	}
		$temp_name=mysql_result(mysql_query("select max(prob_id) from code_problem_pool") ,0);


	
		$myFile = $temp_name.'ip.txt';
		$output = $temp_name.'op.txt';

		shell_exec("mv $path \"questionsetter/$myFile\"");   


		shell_exec("mv $path_2 \"questionsetter/$output\"");  
		mysql_query("update code_problem_pool set input_url='/var/www/questionsetter/$myFile' where prob_id='$temp_name'")or die("##########ip".mysql_error());
		mysql_query("update code_problem_pool set output_url='/var/www/questionsetter/$output' where prob_id='$temp_name'")or die("##########op".mysql_error());
?>



           
           

</p>
<input type="submit" name="submit" value="Add new question" />

</p>
      </form>

</form>
<form action="staff_home.php">
<input type="submit" name="exit" value="Exit" />
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
