<?php
	$_POST = json_decode(file_get_contents('php://input'), true);
	$id = $name = $year = $place = $executor = $architect = $type = $objectType = $style = $price = $yardage = "";
	$tags = [];

	loadFormData();
	saveProject();

	function loadFormData()
	{
		global $id, $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $tags, $files;

		$id = getFormElement("id");
		$name = allowQuotationSigns(getFormElement("name"));
		$year = getFormElement("year");
		$type = allowQuotationSigns(getFormElement("type"));
		$place = allowQuotationSigns(getFormElement("place"));
		$executor = allowQuotationSigns(getFormElement("executor"));
		$architect = allowQuotationSigns(getFormElement("architect"));
		$objectType = allowQuotationSigns(getFormElement("objectType"));
		$style = allowQuotationSigns(getFormElement("style"));
		$yardage = allowQuotationSigns(getFormElement("yardage"));
		$price = getFormElement("price");
		$tags = splitTags(getFormElement("tags"));
	}

	function getFormElement($text)
	{
		return isset($_POST[$text]) ? $_POST[$text] : null;
	}

	function allowQuotationSigns($text)
	{
		$text = preg_replace('/(\')/', '\'', $text);
		$text = preg_replace('/"/', '&quot;', $text);
		return $text;
	}

	function splitTags($tags)
	{
		$tags = preg_replace('/\s+/', ' ', $tags);
		$tags = preg_replace('/(\s,)+/', ',', $tags);
		$tags = preg_replace('/(,\s)+/', ',', $tags);
		$tags = preg_replace('/,+/', ',', $tags);
		$tags = preg_replace('/(^,|,$)/', '', $tags);
		$tags = allowQuotationSigns($tags);
		return preg_split("/[,]+/", $tags);
	}

	function saveProject()
	{
		global $id, $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $objectType, $tags, $files;
		require_once "connect.php";

		$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));
	
		if ($connection->connect_errno != 0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$connection->set_charset("utf8");
			if (addProject($connection, $id, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price))
			{
				$sql = "SELECT MAX(id) AS last_updated_id FROM projects;";
				$id = mysqli_fetch_array(mysqli_query($connection, $sql))["last_updated_id"] or die("Error in Selecting " . mysqli_error($connection)); 
				addTags($connection, $id, $tags);
			}

			mysqli_close($connection);
		}
	}

	function addProject($connection, $id, $name, $year, $type, $place, $executor, $architect, $objectType, $style, $yardage, $price)
	{
		if ($id == null)
			$sql = "INSERT INTO projects(name, year, place, type, executor, architect, objectType, style, yardage, price)
	    			VALUES('$name', '$year', '$place', '$type', '$executor', '$architect', '$objectType', '$style', '$yardage', '$price');";
	    else
			$sql = "UPDATE projects SET name='$name', year='$year', place='$place', type='$type', executor='$executor', architect='$architect', objectType='$objectType', style='$style', yardage='$yardage', price='$price' WHERE id='$id'";

		if(! mysqli_query($connection, $sql))
		{
			die('Error: ' . mysqli_error());
		}
		return true;
	}

	function addTags($connection, $id, $tags)
	{
		if ($id != null)
		{
			$sql = "DELETE FROM tags WHERE project_id = '$id';";
			if(! mysqli_query($connection, $sql))
				die('Error: ' . mysqli_error('Cannot add tags'));
		}

		foreach ($tags as $index => $tag)
		{
			$sql = "INSERT INTO tags(project_id, tag) VALUES('$id', '$tag');";
			if(! mysqli_query($connection, $sql))
				die('Error: ' . mysqli_error('Cannot add tags'));
		}
	}
?>