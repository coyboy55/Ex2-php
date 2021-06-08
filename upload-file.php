<?php
include ('./ViewModel/classFiles.php');
     function after($str, $inthat)
     {
         if (!is_bool(strpos($inthat, $str)))
         return substr($inthat, strpos($inthat,$str)+strlen($str));
     };
// Check if the form was submitted
if(isset($_POST['saveFile'])){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
   
        $typeAllowed = $_FILES["photo"]["type"];
        $extension= after ('/', $typeAllowed);   
        $allowed = array($extension=>$typeAllowed,'pptx'=>'application/pptx');
    
       // $allowed = array('pdf'=>'application/pdf',"jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists(realpath('./upload') . '/' . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], realpath('./upload') . '/' . $filename);
                
                echo "Your file was uploaded successfully.";
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        
        echo "Error: " . $_FILES["photo"]["error"];
    }

$instance=new FileClass();
$name=$_POST['name'];
$sizeKB=(100)*$filesize/1024/100;
$userId=$_COOKIE['idU'];
$instance->createFile($name,$sizeKB,$filetype,$filename,$userId);

}




?>