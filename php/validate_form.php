<?php
	$nameErr = $yearErr = $placeErr = $executorErr = $architectErr = $typeErr =
	$objectTypeErr = $styleErr = $priceErr = $yardageErr = $tagsErr = $filesErr = "";

	$name = $year = $place = $executor = $architect = $type =
	$objectType = $style = $price = $yardage = $tags = $files = "";

	$isCorrectForm = false;

	if (isPostFormSend())
	{
		loadFormData();
		$isCorrectForm = validate();
	}


	function isPostFormSend()
	{
		return getFormElement("submit") != null;
	}

	function loadFormData()
	{
		global $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $tags, $files;

		$name = getFormElement("name");
		$year = getFormElement("year");
		$type = getFormElement("type");
		$place = getFormElement("place");
		$executor = getFormElement("executor");
		$architect = getFormElement("architect");
		$objectType = getFormElement("objectType");
		$style = getFormElement("style");
		$yardage = getFormElement("yardage");
		$price = getFormElement("price");
		$tags = getFormElement("tags");
	}

	function getFormElement($text)
	{
		return isset($_POST[$text]) ? $_POST[$text] : null;
	}

	function validate()
	{
		global $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $tags, $files;
		global $nameErr, $yearErr, $placeErr, $executorErr, $architectErr, $typeErr, $styleErr, $priceErr, $yardageErr, $tagsErr, $filesErr;
		$isCorrectForm = true;

		if ($name == "")
		{
			$isCorrectForm = false;
			$nameErr = "podaj nazwę projektu";
		}

		if (!preg_match("/^(\d+((,|\.)\d{1,2})?)?$/", $price))
		{
			$isCorrectForm = false;
			$priceErr = "wprowadź poprawną liczbę (z zaokrągleniem do dwóch miejsc po przecinku)";
		}

		if (!preg_match("/^(\d+((,|\.)\d{1,2})?)?$/", $yardage))
		{
			$isCorrectForm = false;
			$yardageErr = "wprowadź poprawną liczbę (z zaokrągleniem do dwóch miejsc po przecinku)";
		}

		return 	validateFiles() && $isCorrectForm;
	}

	function validateFiles()
	{
		$target_dir = "images/";    
	    $uploadSuccess = true;

	    $total = count($_FILES["files"]["name"]);

	    for ($i = 0; $uploadSuccess && $i < $total; $i++)
	    {
	        if ($_FILES["files"]["error"][$i] == UPLOAD_ERR_OK)
	        {
	            $target_file = $target_dir . basename($_FILES["files"]["name"][$i]);

	            if (!checkImage($target_file, $i))
	                $uploadSuccess = false;
	        }
	        else
	        {
	        	$filesErr = "błąd w ładowaniu pliku";
	        	$uploadSuccess = false;
	        }
	    }

		return $uploadSuccess;
	}

    function checkImage($target_file, $index)
    {
        return  isCorrectNumberOfFiles() && isFileImage($index) && ifFileAlreadyExists($target_file) &&
        		isImageSizeCorrect($index) && isImageFormatCorrect($target_file);
    }

    function isCorrectNumberOfFiles()
    {
    	global $filesErr;
    	$filesErr = count($_FILES["files"]["name"]) <= 10 ? "" : "maksymalna ilość zdjęć: 10";
    	return $filesErr == "";
    }

    function isFileImage($index) // Check if image file is a actual image or fake image
    {
        global $filesErr;
        $filesErr = getimagesize($_FILES["files"]["tmp_name"][$index]) ? "" : "Podany plik nie jest obrazem.";
        return $filesErr == "";
    }

    function ifFileAlreadyExists($target_file)
    {
        global $filesErr;
        $filesErr = file_exists($target_file) ? "Podany plik już istnieje." : "";
        return $filesErr == "";
    }

    function isImageSizeCorrect($index)
    {
        global $filesErr;
        $filesErr = $_FILES["files"]["size"][$index] <= 2000000 ? "" : "Maksymalny rozmiar pliku 2 MB został przekroczony.";
        return $filesErr == "";
    }

    function isImageFormatCorrect($target_file) // Allow certain file formats
    {
        global $filesErr;
        $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
        $isCorrectType = ($filetype == "jpg" || $filetype == "png" || $filetype == "jpeg" || $filetype == "gif");
        $filesErr = $isCorrectType ? "" : "Nieprawidłowy format pliku. Dozwolone: .jpg .png .jpeg .gif.";
        return $filesErr == "";
    }
?>