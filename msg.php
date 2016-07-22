<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysql_connect($hostname, $username, $password)
or die("Could not open connection to database");

mysql_select_db("305cde", $connection)
or die("Could not select database");
//$result = mysql_query("select * from personal where login='test'");


$method = $_SERVER['REQUEST_METHOD'];
echo $method;


switch ($method){
case 'POST':
	//echo "Here is POST";
	$username=$_POST['username'];
	$subject=$_POST['subject'];
	$date=$_POST['date'];
	$email=$_POST['email'];
	$message=$_POST['message'];

	$checkid=mysql_query("SELECT * from newpost WHERE email='$email'") or die("Could not issue MySQL query");
	
	$records = mysql_num_rows($checkid);
	
	if($records>0){
		
		echo "Duplicate";
		
	}else{
		
		$sqlstring="insert into newpost (username,subject,date,email,message) values ('$username', '$subject', '$date', '$email', '$message')";
		
		mysql_query($sqlstring);
		
	}
	break;
	
	
 
 
case 'PUT':

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


case 'DELETE':

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

 

default:
    rest_error($request); 
    break;

}
?>