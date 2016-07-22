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
	
		if($_GET['type'] =="reg"){
			
			$username=$_GET['username'];
			$password=$_GET['password'];
			
			$checkid=mysql_query("SELECT * from testlogin WHERE username='$username'") or die("Could not issue MySQL query");
			
			$records = mysql_num_rows($checkid);
			
			if($records>0){
				
				echo "success";
				
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
	
	
		$res["result"] = false;
		$res["alert"] = "Invalid format";
		
	}
	
	echo json_encode($res);
	
?>	