<?php
	$errors = array();
	$data = array();
	$_POST = json_decode(file_get_contents('php://input'), true);

	$name = $year = $place = $executor = $architect = $type =
	$objectType = $style = $price = $yardage = "";
	$tags = [];

	if (isPostFormSend())
	{
		loadFormData();
		validate();
	}

	if (!empty($errors))
 		$data['errors']  = $errors;
	else
		$data['message'] = 'Form data is going well';

	echo json_encode($data);

	function isPostFormSend()
	{
		return getFormElement("submit") != null;
	}

	function loadFormData()
	{
		global $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $tags, $files;

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

	function allowQuotationSigns($text)
	{
		$text = preg_replace('/(\')/', '\'', $text);
		$text = preg_replace('/"/', '&quot;', $text);
		return $text;
	}

	function validate()
	{
		global $errors;
		global $name, $year, $place, $executor, $architect, $type,	$style, $price, $yardage, $tags, $files;
		$isCorrectForm = true;

		if ($name == "")
		{
			$isCorrectForm = false;
			$errors['name'] = "podaj nazwę projektu";
		}

		if (!preg_match("/^(\d+((,|\.)\d{1,2})?)?$/", $price))
		{
			$isCorrectForm = false;
			$errors['price'] = "wprowadź poprawną liczbę (maksymalnie dwa miejsca po przecinku)";
		}

		if (!preg_match("/^(\d+((,|\.)\d{1,2})?)?$/", $yardage))
		{
			$isCorrectForm = false;
			$errors['yardage'] = "wprowadź poprawną liczbę (maksymalnie dwa miejsca po przecinku)";
		}

		return 	validateFiles() && $isCorrectForm;
	}

	function validateFiles()
	{
		global $errors;
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
	        	if ($_FILES["files"]["error"][$i] != UPLOAD_ERR_NO_FILE)
	        	{
		        	$errors['files'] = "błąd w ładowaniu pliku";
		        	$uploadSuccess = false;
	        	}
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
    	global $errors;
    	$errors['files'] = count($_FILES["files"]["name"]) <= 10 ? "" : "maksymalna ilość zdjęć: 10";
    	return $errors['files'] == "";
    }

    function isFileImage($index) // Check if image file is a actual image or fake image
    {
        global $errors;
        $errors['files'] = getimagesize($_FILES["files"]["tmp_name"][$index]) ? "" : "Podany plik nie jest obrazem.";
        return $errors['files'] == "";
    }

    function ifFileAlreadyExists($target_file)
    {
        global $errors;
        $errors['files'] = file_exists($target_file) ? "Podany plik już istnieje." : "";
        return $errors['files'] == "";
    }

    function isImageSizeCorrect($index)
    {
        global $errors;
        $errors['files'] = $_FILES["files"]["size"][$index] <= 2000000 ? "" : "Maksymalny rozmiar pliku 2 MB został przekroczony.";
        return $errors['files'] == "";
    }

    function isImageFormatCorrect($target_file) // Allow certain file formats
    {
        global $errors;
        $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
        $isCorrectType = ($filetype == "jpg" || $filetype == "png" || $filetype == "jpeg" || $filetype == "gif");
        $errors['files'] = $isCorrectType ? "" : "Nieprawidłowy format pliku. Dozwolone: .jpg .png .jpeg .gif.";
        return $errors['files'] == "";
    }
?>