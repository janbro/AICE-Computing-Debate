<?php
include_once 'functions.php';

echo "Submit info";
if (isset($_GET['cancel'])){
    echo $_GET['action'];
    header('Location: ../index.php');
}





//Clean Up!!!
$files = glob('temp/*'); // get all file names
foreach($files as $file){ // iterate files
    if(is_file($file))
    unlink($file); // delete file
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
