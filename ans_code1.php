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
	
}
if(isset($_POST['next']))
{
echo $_SESSION['iter'];
++$_SESSION['iter'];
}
?>
