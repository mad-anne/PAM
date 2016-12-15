<?php
	if ($isCorrectForm)
		saveProject();

	function saveProject()
	{
		require_once "connect.php";

		$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));
	
		if ($connection->connect_errno != 0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$connection->set_charset("utf8");
			addProject($connection, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price);
			addFiles();
			mysqli_close($connection);
			loadIndexPage();
		}
	}

	function addProject($connection, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price)
	{
		$sql = "INSERT INTO projects(name, year, place, type, executor, architect, objectType, style, yardage, price)
    			VALUES('$name', '$year', '$place', '$type', '$executor', '$architect', '$objectType', '$style', '$yardage', '$price')";

		if(! mysqli_query($connection, $sql))
		{
			die('Error: ' . mysql_error());
		}
	}

	function addFiles()
	{
		$target_dir = "images/";    
	    $uploadSuccess = true;

	    $total = count($_FILES["files"]["name"]);

	    for($i = 0; $i < $total; $i++)
	    {
	        $target_file = $target_dir . basename($_FILES["files"]["name"][$i]);

	        if (!uploadFile($target_file, $i))
	            $uploadSuccess = false;
	    }

	    return $uploadSuccess;
	}

    function uploadFile($target_file, $index)
    {
        return move_uploaded_file($_FILES["files"]["tmp_name"][$index], $target_file);
    }

	function loadIndexPage()
	{
		header('Location: index.php');
	}
?>