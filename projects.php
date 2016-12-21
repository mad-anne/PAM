<?php
	$projects = array();
	loadData();

	function loadData()
	{
		global $projects;
		require_once "php/connect.php";

		$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));
		
		if ($connection->connect_errno != 0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$connection->set_charset("utf8");
			$projects = getProjects($connection);
			mysqli_close($connection);
		}
	}

	function getProjects($connection)
	{
		$projects = selectData($connection, "SELECT * FROM projects");

		for ($i = 0; $i < count($projects); $i++)
		{
			$projects[$i]["images"] = getImagesForProject($connection, $projects[$i]["id"]);
			$projects[$i]["tags"] = getTagsForProject($connection, $projects[$i]["id"]);
		}

		return $projects;
	}

	function getImagesForProject($connection, $id)
	{
		$results = array();
		$img_dir = "images/";
		$img_id = basename(str_pad($id, 6, '0', STR_PAD_LEFT));
		$startPath = $img_dir . 'img' . $img_id;
		$results = glob($startPath . "??.???");

		return $results;
	}

	function getTagsForProject($connection, $id)
	{
		return selectData($connection, "SELECT tag FROM tags WHERE project_id = $id");
	}

	function selectData($connection, $sql)
	{
		$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
		
		$results = array();

		while($row = mysqli_fetch_assoc($result))
		{
			$results[] = $row;
		}

		return $results;
	}
?>

<script>
	var projects = <?php echo json_encode($projects); ?>;
</script>