<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysql_connect($hostname, $username, $password)
or die("Could not open connection to database");

mysql_select_db("305cde", $connection)
or die("Could not select database");

	if(isset($_GET['type']))
	{
		//$res = [];
	
		if($_GET['type'] =="userlogin"){
			
			$username=$_GET['username'];
			$password=$_GET['password'];
			
			// Check Username and Password
			$checkid=mysql_query("SELECT * from testlogin WHERE username='$username' and password='$password'") or die("Could not issue MySQL query");
			
			$records = mysql_num_rows($checkid);
			
			if($records>0){
				// Login Success
				$res["result"] = true;
				$res["alert"] = "Login Successful";
			}else{
				
				echo "Fail to login";
				return;
				
			}
			
		}
	
	}
	else{
	
		$sth = mysql_query("SELECT * FROM testlogin"); 
		$rows = array();
		while($r = mysql_fetch_assoc($sth)) {
			$rows[] = $r;
		}
		print json_encode($rows);
	
		// Reture Error
		$res["result"] = false;
		$res["alert"] = "Invalid format";
		
	}
	
	echo json_encode($res);
	
?>	