<?php
class Auth_staff 
{
	private $siteKey;
  	public function connect()
	{
		$con = mysql_connect('localhost','root','mysql');
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		// make userdata the current db
		$db_selected = mysql_select_db('aces', $con);
		if (!$db_selected) {
    		die ('Can\'t use userdata : ' . mysql_error());
		}
		return $con;
	}

	public function disconnect($con)
	{
		mysql_close($con);
	}

	public function __construct()
  	{
		$this->siteKey = 'adsvdsugygabhbbdh2767';
	}

	public function randomString($length = 50)
	{
		$characters = '0123456789abcdefghijklmnopqrstaffvwxyz';
		$string = '';   
		for ($p = 0; $p < $length; $p++)
		{
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
	    return $string;
	}

	protected function hashData($data)
    {
		return hash_hmac('sha512', $data, $this->siteKey);
	}

	public function createUser($reg_id, $password, $address,$designation,$dob,$dept,$name,$con,$gender)
	{			
		//Generate users salt
		$user_salt = $this->randomString();
			
		//Salt and Hash the password
		$password = $user_salt . $password;
		$password = $this->hashData($password);
			
		//Create verification code
		$code = $this->randomString();

		//Commit values to database here.
		$db=$this->connect();
		$query = "INSERT into staff(staff_id,pass,user_salt,address,department,designation,name,dob,contact,gender) values('$reg_id','$password','$user_salt','$address','$dept','$designation','$name','$dob','$con','$gender')";
        $created = mysql_query($query) or die("cant insert".mysql_error());
		$this->disconnect($db);
		if($created != false)
		{
			return true;
		}
	    return false;
	}

	public function login($reg_id, $password)
	{
		//Select users row from database base on $reg_id
		$db=$this->connect();
		$result = mysql_query("SELECT * FROM staff WHERE staff_id = '$reg_id'");
		if (!$result)
		{
		    echo 'Could not run query: ' . mysql_error();
		    exit;
		}

		$selection = mysql_fetch_array($result);
		
		//Salt and hash password for checking
		$password = $selection['user_salt'] . $password;
		$password = $this->hashData($password);
		
		//Check reg_id and password hash match database row
		$match=((strcmp($selection['pass'],$password))==0);
		
		if($match == true) 
		{
			//reg_id/Password combination exists, set sessions
			//First, generate a random string.
			$random = $this->randomString();
			//Build the token
			$token = $_SERVER['HTTP_USER_AGENT'] . $random;
			$token = $this->hashData($token);
			
			//Setup sessions vars
			session_start();
			$_SESSION['token'] = $token;
			$_SESSION['user_id'] = $selection['id'];
			$_SESSION['role'] = 'staff';
			$_SESSION['name'] = $selection['name'];
			
			//Update old logged_in_member records for user
			$kp = mysql_query("select * from logged_in_staff where user_id ='$selection[id]'");
 			if(mysql_num_rows($kp)==1)
			{
				 $sid=session_id();
			   	 $update = mysql_query("UPDATE logged_in_staff SET session_id='$sid',token='$token' WHERE user_id = '$_SESSION[user_id]'") ;
				 if ($update)
				 {
				    $this->disconnect($db);
				    return true;
				 }
			}
			else
			{
				$sid=session_id();
				 //Insert new logged_in_member record for user
				 $inserted = mysql_query("INSERT into logged_in_staff(user_id,session_id,token) values('$_SESSION[user_id]','$sid','$token') ");
				 if ($inserted) 
				 {
				    $this->disconnect($db);
				    return true;
				 }
			}
				
		}
		return false;
	}


	public function checkSession()
	{
		//Select the row
		$db=$this->connect();
		
		$result = mysql_query("SELECT * FROM logged_in_staff WHERE user_id = '$_SESSION[user_id]'");
		if (!$result) {
		    echo 'Could not run query: ' . mysql_error();
		    exit;
		}

		$selection = mysql_fetch_array($result);
		
		
		if($selection) {
			//Check ID and Token
				
			if(session_id() == $selection['session_id'] && $_SESSION['token'] == $selection['token']) {
				//Id and token match, refresh the session for the next request
				$this->refreshSession();
				$this->disconnect($db);
				return true;
			}
		}
		$this->disconnect($db);
		
                  
		return false;
	}

	private function refreshSession()
	{
		//Regenerate id
		session_regenerate_id();
		
		//Regenerate token
		$random = $this->randomString();
		//Build the token
		$token = $_SERVER['HTTP_USER_AGENT'] . $random;
		$token = $this->hashData($token); 
		
		//Store in session
		$_SESSION['token'] = $token;
	      $sid=session_id();

		//update logged_in_member table
		$update = mysql_query("UPDATE logged_in_staff SET session_id='$sid',token='$token' WHERE user_id = '$_SESSION[user_id]'") or die('failed');
		 if ($update)
		 {
		    return true;
		 }
	}

	public function logout()
	{
		$db=$this->connect();
		$delete = mysql_query("DELETE from logged_in_staff WHERE user_id = '$_SESSION[user_id]'");
		$this->disconnect($db);
		 if ($delete)
		 {
		    return true;
		 }
		session_unset();
		session_destroy();
	}
	
	public function __toString()
	{
		return $this->siteKey;
	}
}
?>


