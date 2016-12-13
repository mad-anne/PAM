<?php
	require_once "php/connect.php";

	$projects = array();

	$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));
	
	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
		$sql = "SELECT * FROM projects";
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
			
		while($row = mysqli_fetch_assoc($result))
		{
			$projects[] = $row;
		}
	}

?>