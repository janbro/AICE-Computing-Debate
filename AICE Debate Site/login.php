<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        
        <title>Login</title>
    </head>
    <body><br>
        <div class="container">
            <h1 class="title" style="text-align: center">Login</h1>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> 
            <form action="includes/process_login.php" method="post" name="login_form">       
            
            <div class="row">
                <div class="six columns">
                    <label for="exampleEmailInput">Email</label>
                    <input class="u-full-width" type="text" name="email" />
                </div>
                
                <div class="six columns">
                    <label for="exampleEmailInput">Password</label>
                    <input class="u-full-width" type="password" 
                             name="password" 
                             id="password"/>
                </div>
                
            </div>
                <label for="exampleEmailInput"> </label>
                <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> 
                
        </form>
 
<?php
        if (login_check($mysqli) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
 
            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                }
?>      
            </div>
    </body>
</html>