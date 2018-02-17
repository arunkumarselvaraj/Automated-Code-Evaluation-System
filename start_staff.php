<?php
require_once 'Auth_staff.php';

session_start();

$auth = new Auth_staff();

if (!isset($_SESSION['user_id'])) {
	//Not logged in, send to login page.
	header( 'Location: login.php' );
} else {
	//Check we have the right user
	$logged_in = $auth->checkSession();
	
	if(empty($logged_in)){
		//Bad session, ask to login
		$auth->logout();
		header( 'Location: login.php' );
		
	} else {
		//User is logged in, show the page
		echo 'rudhra ';
	}
}
?>

