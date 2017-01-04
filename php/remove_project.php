<?php
	$projectId = $_GET['id'];
	removeProject();

	function removeProject()
	{
		global $projectId;

		require_once "connect.php";
		$connection = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Error " . mysqli_error($connection));

		if ($connection->connect_errno != 0)
		{
			echo "Error: ".$connection->connect_errno;
		}
		else
		{
			$connection->set_charset("utf8");
			removeProjectData($connection, $projectId);
			removeProjectImages($projectId);
			mysqli_close($connection);
		}
	}

	function removeProjectData($connection, $id)
	{
		$sql = "DELETE FROM projects WHERE id = '$id';";

		if(! mysqli_query($connection, $sql))
		{
			die('Error: ' . mysql_error());
		}
		return true;
	}

	function removeProjectImages($id)
	{
		$target_dir = "../images/";
		$target_prefix = $target_dir . 'img' .str_pad($id, 6, "0", STR_PAD_LEFT);
		$mask = $target_prefix . '??.*';
		array_map('unlink', glob($mask));
	}
?>