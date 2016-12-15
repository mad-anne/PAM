<?php
    $target_dir = "images/";    
    $uploadSucces = true;

    $total = count($_FILES["projectFiles"]["name"]);

    if ($total > 10)
    {
        $projectFilesErr = "Możesz dodać maksymalnie 10 zdjęć.";
        $uploadSucces = false;
    }

    for($i = 0; $uploadSucces && $i < $total; $i++)
    {
        echo "wykonuję się";
        if ($_FILES["projectFiles"]["error"][$i] == UPLOAD_ERR_OK)
        {
            $target_file = $target_dir . basename($_FILES["projectFiles"]["name"][$i]);

            if (!checkImage($target_file, $i) || !uploadFile($target_file, $i))
                $uploadSucces = false;
        }
    }

    function checkImage($target_file, $index)
    {
        return  isSendWithPostMethod() && isFileImage($index) && ifFileAlreadyExists($target_file)
                && isImageSizeCorrect($index) && isImageFormatCorrect($target_file);
    }

    function isSendWithPostMethod()
    {
        return isset($_POST["submit"]);
    }

    function isFileImage($index) // Check if image file is a actual image or fake image
    {
        global $projectFilesErr;
        $projectFilesErr = getimagesize($_FILES["projectFiles"]["tmp_name"][$index]) ? "" : "Podany plik nie jest obrazem.";
        return $projectFilesErr == "";
    }

    function ifFileAlreadyExists($target_file)
    {
        global $projectFilesErr;
        $projectFilesErr = file_exists($target_file) ? "Podany plik już istnieje." : "";
        return $projectFilesErr == "";
    }

    function isImageSizeCorrect($index)
    {
        global $projectFilesErr;
        $projectFilesErr = $_FILES["projectFiles"]["size"][$index] <= 2000000 ? "" : "Maksymalny rozmiar pliku 2 MB został przekroczony.";
        return $projectFilesErr == "";
    }

    function isImageFormatCorrect($target_file) // Allow certain file formats
    {
        global $projectFilesErr;
        $filetype = pathinfo($target_file, PATHINFO_EXTENSION);
        $isCorrectType = ($filetype == "jpg" || $filetype == "png" || $filetype == "jpeg" || $filetype == "gif");
        $projectFilesErr = $isCorrectType ? "" : "Nieprawidłowy format pliku. Dozwolone: .jpg .png .jpeg .gif.";
        return $projectFilesErr == "";
    }

    function uploadFile($target_file, $index)
    {
        global $projectFilesErr;
        $projectFilesErr = move_uploaded_file($_FILES["projectFiles"]["tmp_name"][$index], $target_file) ? "" : "Nie udało się zapisać pliku.";
        return $projectFilesErr == "";
    }
?>
