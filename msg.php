<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysql_connect($hostname, $username, $password)
or die("Could not open connection to database");

mysql_select_db("305cde", $connection)
or die("Could not select database");


// Switch POST, PUT, DELETE method
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){


case 'POST':
	// Add New Post into Database
	if(isset($_POST['type']))
	{
		if($_POST['type'] =="postmsg"){
			
			$username=$_POST['username'];
			$subject=$_POST['subject'];
			$date=$_POST['date'];
			$email=$_POST['email'];
			$message=$_POST['message'];
			
			// Check if the Username and Email are registered
			$checkid=mysql_query("SELECT * from testlogin WHERE username='$username' and email='$email'") or die("Could not issue MySQL query");
			$records = mysql_num_rows($checkid);
			
			// If Username and Email are correct, add New Post into database
			if($records>0){
				$sqlstring="insert into newpost (username,subject,date,email,message) values ('$username', '$subject', '$date', '$email', '$message')";
				mysql_query($sqlstring);
				// Success
				$res["result"] = true;
				$res["alert"] = "This message has been posted successfully";
			}else{
				// Reture Error Message if Wrong Username or Email
				return;
				$res["result"] = false;
				$res["alert"] = "Invaild Username or Email";
			}
			
		}
	
	}
	
	echo json_encode($res);
	break;
	
//----------------------------------------------------
	
case 'PUT':
	// Update Message Board Subject and Content
    parse_str(file_get_contents("php://input"),$post_vars);
   
	$username=$post_vars['username'];
	$email=$post_vars['email'];
	$newsubject=$post_vars['newsubject'];
	$newmessage=$post_vars['newmessage'];
	
	$checkid=mysql_query("SELECT * from newpost WHERE username='$username' and email='$email'") or die("Could not issue MySQL query");

	$records = mysql_num_rows($checkid);
	if($records>0){
	
		$sqlstring="update newpost set subject='$newsubject', message='$newmessage' where username='$username'";
		
		mysql_query($sqlstring);
		
	}else{
		echo "No user found";
		return;
	}

    break;
			
	
	
//----------------------------------------------------
	
	
case 'DELETE':
	// Delete from database
    parse_str(file_get_contents("php://input"),$post_vars);
 
	$username=$post_vars['username'];
	$email=$post_vars['email'];

	$checkid=mysql_query("SELECT * from newpost WHERE username='$username' and email='$email'") or die("Could not issue MySQL query");
	$records = mysql_num_rows($checkid);

	if($records>0){
		
		$sqlstring="DELETE from newpost WHERE email='$email'" ;
		mysql_query($sqlstring);
		
	}else{
		 echo "No user found";
		 return;
	}

    break;

	
	
}
?>