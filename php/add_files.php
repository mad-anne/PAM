<?php
	if (isset($_FILES["files"]) && isset($_FILES["files"]["name"]))
		uploadFiles();

	function uploadFiles()
	{
		$projectId = isset($_POST["id"]) ? $_POST["id"] : getLastUpdatedProjectId();
		$target_dir = "../images/";
		$target_prefix = $target_dir . 'img' .str_pad($projectId, 6, "0", STR_PAD_LEFT);

		$firstIndex = 0;
		$lastIndex = $firstIndex + count($_FILES["files"]["name"]) - 1;

		for($i = $firstIndex; $i <= $lastIndex; $i++)
		{
		    echo 'w funkcji';
			$fileToUpload = $_FILES["files"]["tmp_name"][$i];
			$ext = pathinfo($_FILES["files"]["name"][0], PATHINFO_EXTENSION);
			$target_suffix = str_pad($i, 2, "0", STR_PAD_LEFT);
			$target = $target_prefix . $target_suffix . '.' . $ext;

			var_dump(file_exists($target));

			if (!file_exists($target))
			    move_uploaded_file($fileToUpload, $target);
            else
                $lastIndex++;
		}
	}

	function getLastUpdatedProjectId()
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
			$sql = "SELECT MAX(id) AS last_updated_id FROM projects;";
			$id = mysqli_fetch_array(mysqli_query($connection, $sql))["last_updated_id"] or die("Error in Selecting " . mysqli_error($connection)); 
			mysqli_close($connection);
			return $id;
		}
		return -1;
	}
?>