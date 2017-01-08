<?php
    $data = file_get_contents( "php://input" );
    $images = explode(',', $data);

    for ($i = 0; $i < count($images); $i++)
        removeImage($images[$i]);

    function removeImage($image)
    {
        $target_dir = "../images/";
        $target = $target_dir . $image;
        unlink($target);
    }
?>