<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Oops! An unknown error happened.';
}
$error = $_SESSION['error'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
        <title>Error</title>
    </head>
    <body><br>
        <div class="container" style="text-align: center">
        <h1>There was a problem</h1>
        <p class="error"><?php echo $error; ?></p>  
            <a class="button button-primary" href="login.php">Go back</a>.
        </div>
    </body>
</html>