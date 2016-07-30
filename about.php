<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysqli_connect($hostname, $username, $password, "305cde")
or die("Could not open connection to database");

	// GET data from about table
	$result = mysqli_query($connection, "SELECT * FROM about"); 
	$data = array();
	// Fetch data
	while ( $row = mysqli_fetch_row($result) )
		{
		  $data[] = $row;
		}
	echo json_encode( $data );
 
?>