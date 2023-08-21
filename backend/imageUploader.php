<?php
//The $storageDir variable represents the path where the images to be uploaded will be stored.
$storageDir = "uploads/";

//the basename() function returns the filename from a path. $_FILES['file']['name'] refers to the name of the uploaded file as it is onn the client machine
$fileName = basename($_FILES["file"]['name']);

//The targetFilePath is the path of the file to be uploaded. $storageDir is the path where the file will be stored. $fileName is the name of the file to be uploaded
$targetFilePath = $storageDir . $fileName;

//the fileType variable is where we wish to store the extension of the file we want to upload. The pathinfo() function returns information about a file path. PATHINFO_EXTENSION returns the extension of the file.
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

//The array $allowedFileType stores the allowed file extensions to be used to validate the uploaded file. 
$allowedFileTypes = ["jpg", "png", "jpeg", "gif"];

//The in_array() method checks if a value exists in an array. In this case, we want to check if the extension of the file ($fileType) exists in the array of allowed files ($allowedFileType)
if (in_array($fileType, $allowedFileTypes)) {
    // The file_exists() function checks if a file or directory is in existence. $targetFilePath is the file we want to check if it exists in our uploads folder
    if(file_exists($targetFilePath)){
        echo "File exists in the server";
    }else{
        //The move_uploaded_file() method moves an uploaded file to a new location. carries 2 args, the file to be moved ($_FILES(['file']['tmp_name']) and the new location it is to be moved to ($targetFilePath)
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            echo "File Uploaded successfully";
        }else{
            echo "File upload failed, try again later";
        }
    }
}else{
    echo "Invalid file type";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="imageUploader.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button>Submit</button>
</form>
</body>
</html>