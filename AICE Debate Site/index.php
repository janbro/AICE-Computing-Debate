<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "AICE";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM students ORDER BY wins DESC;";
$result = $conn->query($sql);

$index = 0;

$data = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($data,array('name' => $row["name"],'wins' => $row["wins"],'score' => $row["score"])); 
    }
}

function build_table($array){

    // start table

    $html = '<table class="u-full-width">';

    // header row

    $html .= '<tr>';

    foreach($array[0] as $key=>$value){

            $html .= '<th>' . $key . '</th>';

        }
        
        if(empty( $array[0])){
            $html .= '<th>name</th><th>wins</th><th>score</th>';
        }
    $html .= '</tr>';

    // data rows

    foreach( $array as $key=>$value){

        $html .= '<tr>';

        foreach($value as $key2=>$value2){

            $html .= '<td>' . $value2 . '</td>';

        }

        $html .= '</tr>';

    }

    // finish table and return it

    $html .= '</table>';

    return $html;

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="favicon.ico" type="image/x-icon" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
        <title>Debate Scores</title>
    </head>
    </head>
    <body>
        <form action="createStudent.php" method="post">
            <!--SELECT STUDENTS AND DISPLAY INFO: x and add at bottom-->
        </form>
        <div class="container">
        <div class="row">
            <div class="two columns">
                <img alt="Debate Logo" style="margin-top: 20px" width="100%" src="images/debaytelogo.png">
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <h1 class="title" style="text-align: center;">Scoreboard</h1>
            </div>
        </div>
            <div class="row">
                    <?php
                    if (login_check($mysqli) == true) {
                        echo '<div class="two columns">';
                        echo '<a class="button button-primary" href="manageStudents.php">Manage</a>';
                        echo '</div>';
                        echo '<div class="eight columns">';
                        echo '<h1></h1>';
                        echo '</div>';
                        echo '<div class="two columns">';
                        echo htmlentities($_SESSION['username']);
                        echo ' <a href="includes/logout.php">Log out</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="ten columns">';
                        echo '<h1></h1>';
                        echo '</div>';
                        
                        echo '<div class="two columns">';
                        echo '<a class="button" href="login.php">Login</a>';
                        echo '</div>';
                    }
                    ?>
            </div>
            <div class="row">
                <div class="twelve columns">
                <?php echo build_table($data); ?>
                </div>
            </div>
        </div>
        </div>

    <div class="container" style="text-align: right">
    
    <footer>
      <p>Created by: <a href ="https://www.github.com/janbro" target="https://www.github.com/janbro">Alejandro Munoz</a></p>
    </footer>
    </div>
    </body>
</html>
