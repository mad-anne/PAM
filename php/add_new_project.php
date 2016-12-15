<?php
	if ($isCorrectForm)
		saveProject();

	function saveProject()
	{
		global $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $objectType, $tags, $files;
		require_once "connect.php";

		$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));
	
		if ($connection->connect_errno != 0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$connection->set_charset("utf8");
			if (addProject($connection, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price))
			{
				addTags($connection, $tags);
				addFiles();
			}
			
			mysqli_close($connection);
			loadIndexPage();
		}
	}

	function addProject($connection, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price)
	{
		$sql = "INSERT INTO projects(name, year, place, type, executor, architect, objectType, style, yardage, price)
    			VALUES('$name', '$year', '$place', '$type', '$executor', '$architect', '$objectType', '$style', '$yardage', '$price');";

		if(! mysqli_query($connection, $sql))
		{
			die('Error: ' . mysql_error());
		}
		return true;
	}

	function addTags($connection, $tags)
	{
		$sql = "SELECT MAX(id) AS last_updated_id FROM projects;";
		$id = mysqli_fetch_array(mysqli_query($connection, $sql))["last_updated_id"] or die("Error in Selecting " . mysqli_error($connection));

		foreach ($tags as $index => $tag)
		{
			$sql = "INSERT INTO tags(project_id, tag) VALUES('$id', '$tag');";
			if(! mysqli_query($connection, $sql))
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