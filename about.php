<?php
$hostname = "localhost";
$username = "simpiratio_305";
$password = "Lo24768";
$connection = mysqli_connect($hostname, $username, $password, "simpiratio_305")
or die("Could not open connection to database");

	// GET data from about table
	$result = mysqli_query($connection, "SELECT * FROM about"); 
	$data = array();
	while ( $row = mysqli_fetch_row($result) )
		{
		  $data[] = $row;
		}
	echo json_encode( $data );
 
?>