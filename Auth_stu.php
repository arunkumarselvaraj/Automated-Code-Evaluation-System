<?php
class Auth_stu
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
		if (!$db_selected)
		{
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
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = "";    
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

	public function createUser($reg_id, $name, $password, $address,$con,$batch,$dept,$gender,$dob)
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
		$query="INSERT into stu(stu_id,user_salt,name,p,address,contact,batch,department,gender,dob) values('$reg_id','$user_salt','$name', '$password', '$address','$con','$batch','$dept','$gender','$dob')" ;
		$created = mysql_query($query)or die("no use".mysql_error());
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
		$result = mysql_query("SELECT * FROM stu WHERE stu_id = '$reg_id'");
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
		$match=((strcmp($selection['p'],$password))==0);
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
			$_SESSION['role'] = 'student';
			$_SESSION['name'] = $selection['name'];
			
			//Update old logged_in_member records for user
			$kp = mysql_query("select * from logged_in_stu where user_id ='$_SESSION[user_id]'");
 			if(mysql_num_rows($kp)==1)
			{
				 $sid=session_id();
			   	 $update = mysql_query("UPDATE logged_in_stu SET session_id='$sid',token='$token' WHERE user_id = '$_SESSION[user_id]'");
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
				 $inserted = mysql_query("INSERT into logged_in_stu(user_id,session_id,token) values('$_SESSION[user_id]','$sid','$token') ");
				 if ($inserted) 
				 {
				    $this->disconnect($db);
				    return true;
				 }
			}
				
		}
		return false;
	}
	
	public function logout()
	{
		$db=$this->connect();
		$delete = mysql_query("DELETE from logged_in_stu WHERE user_id = '$_SESSION[user_id]'");
		$this->disconnect($db);
		session_unset();
		session_destroy();
		return $delete;
	}

	public function checkSession()
	{
		//Select the row
		$db=$this->connect();
		$result = mysql_query("SELECT * FROM logged_in_stu WHERE user_id = '$_SESSION[user_id]'");
		if (!$result) 
		{
		    echo 'Could not run query: ' . mysql_error();
		    exit;
		}
		$selection = mysql_fetch_array($result);
		if($selection) 
		{
			//Check ID and Token
			if(session_id() == $selection['session_id'] && $_SESSION['token'] == $selection['token']) 
			{
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

		//update logged_in_member table
		$sid=session_id();
		$update = mysql_query("UPDATE logged_in_stu SET session_id='$sid',token='$token' WHERE user_id = '$_SESSION[user_id]'");
		if ($update)
		{
		   return true;
		}
	}

	public function __toString()
	{
		return $this->siteKey;
	}
}
?>
