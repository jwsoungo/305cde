<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysql_connect($hostname, $username, $password)
or die("Could not open connection to database");

mysql_select_db("305cde", $connection)
or die("Could not select database");


	if(isset($_POST['type']))
	{
		//$res = [];
	
		if($_POST['type'] =="reg"){
			
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			
			$checkid=mysql_query("SELECT * from testlogin WHERE username='$username'") or die("Could not issue MySQL query");
			
			$records = mysql_num_rows($checkid);
			
			if($records>0){
				
				echo "Duplicate";
				
			}else{
				

				$query1  = "insert into testlogin (username,password,email) values ('$username', '$password', '$email')";
				$result1 = mysql_query($query1);
		
				if($result1)
				{
		
					$res["result"] = true;
					$res["alert"] = "You have Successfully Registered";
				}

				
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
	
	
		$res["result"] = false;
		$res["alert"] = "Invalid format";
		
	}
	
	echo json_encode($res);
	
?>