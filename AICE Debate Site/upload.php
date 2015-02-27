<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == false){
    header('Location: ../unauthorized.html');
}else{
    $target_dir = "Uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            header('Location: ../error.php');
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['error'] = "Sorry, file already exists.";
        $uploadOk = 0;
        header('Location: ../error.php');
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $uploadOk==1) {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        header('Location: ../error.php');
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000 && $uploadOk==1) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        $uploadOk = 0;
        header('Location: ../error.php');
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header('Location: ../error.php');
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $command = "tesseract \"" . str_replace('/','\\',basename($_FILES["fileToUpload"]["name"])) . "\" out -l"; //hocr
            $output = shell_exec("cd Uploads && " . $command);
            rename($target_file,"temp/tempImage.jpg");
            rename("Uploads/out.txt","temp/out.txt");
            $command = "cd Python_Scripts && python \"Predictive Reading.py\"";
            shell_exec($command);
            echo "<br>You're score sheet is being processed...";
            header('Location: ../confirmForm.php');
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header('Location: ../error.php');
        }
    }
}
?>
