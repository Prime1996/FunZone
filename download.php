<?php
    $name = $_GET['id'];
    $filePath = "upload/".$name;
    if(file_exists($filePath)) {
        $fileName = basename($filePath);
        $fileSize = filesize($filePath);

        header("Cache-Control: private");
        header("Content-Type: application/stream");
        header("Content-Length: ".$fileSize);
        header("Content-Disposition: attachment; filename=".$fileName);

        readfile ($filePath);
        exit();
    }
    else {
        die('The provided file path is not valid.');
    }


 ?>
