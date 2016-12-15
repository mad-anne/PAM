<?php
	$name = getFormElement("projectName");
	$year = getFormElement("projectYear");
	$type = getFormElement("projectType");
	$place = getFormElement("projectPlace");
	$executor = getFormElement("projectExecutor");
	$architect = getFormElement("projectArchitect");
	$objectType = getFormElement("projectObjectType");
	$style = getFormElement("projectStyle");
	$yardage = getFormElement("projectYardage");
	$price = getFormElement("projectPrice");
	$tags = getFormElement("projectTags");

	if (validateForm())
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
			$projects = addProject($connection, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price);
			mysqli_close($connection);

			require_once "add_files.php";

			if ($uploadSucces)
				loadIndexPage();
		}
	}

	function getFormElement($text)
	{
		return isset($_POST[$text]) ? $_POST[$text] : null;
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

	function loadIndexPage()
	{
		header('Location: index.php');
	}

	function validateForm()
	{
		global $name, $projectNameErr;

		if ($name == "")
		{
			$projectNameErr = "podaj nazwę projektu";
			return false;
		}

		return true;
	}
?>