<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Upload</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
    </head>
    <body>
        <br>
        <?php if (login_check($mysqli) == true) : ?>
            
            <div class="container" style="text-align: center">
            <h1 class="title" style="text-align: center">Upload</h1>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    
                <div class="row">
                    Select image to upload:
                    <input class="button-primary" type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <a class="button" href="manageStudents.php">Go back</a>.
                <input class="button-primary" type="submit" value="Upload Image" name="submit">
                </form>
            </div>
        <?php else : 
            header('Location: ../unauthorized.html');
        endif; ?>
    </body>
</html>