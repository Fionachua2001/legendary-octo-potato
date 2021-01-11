<?php
//get the details for uploaded file
$file = $_FILES["fileUpload"];
$fileName = $_FILES["fileUpload"]["name"]; //original name of the file to be uploaded
$fileTmpName = $_FILES["fileUpload"]["tmp_name"]; //temporary filename of the file in which the uploaded file was stored on the server
$fileSize = $_FILES["fileUpload"]["size"]; //size, in bytes, of the uploaded file
$fileError = $_FILES["fileUpload"]["error"]; //error code associated with this file upload
$fileType = $_FILES["fileUpload"]["type"];// the mime type of the file

//define upload folder (relative to current path)
$uploadFolder= "Uploads/";
$maxFileSizeinBytes=1000000; //max 1MB
//extract file extension
$fileExt = explode ("." ,$fileName); //explode is to split the filename and put them into an array of strings and the separator is the dot
//when print_r($fileExt), you will see that the filename has been split into file name and its extension
$fileActualExt = strtolower(end($fileExt)); //extract the actual extension and convert to lowercase
//define allowed extension
$allowed = array("jpg","jpeg","png"); //format allowed

if(in_array($fileActualExt,$allowed)){
    if($fileError === 0){
        //no error
        if($fileSize < $maxFileSizeinBytes){
            //if filesize less than max file size, it will autogenrate unique id using current time in micoseconds for the filename
            $fileNameNew = uniqid('IMG_',false).".".$fileActualExt;
            $fileDestination =$uploadFolder.$fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);
            updateDB($fileDestination);
            echo "Success!";
        }
        else{
            echo "Your file is too big!";
        }
    }
    else{
        echo "There was an error uploading the file.";
    }
}
else{
    echo "You cannot upload files of this type";
}
function updateDB($fileDestination){
    include 'db_connect.php';
    $stmt =$conn->prepare("insert into tb_images (sFilePath) values (?)");
    $stmt->bind_param('s',$fileDestination);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

?>