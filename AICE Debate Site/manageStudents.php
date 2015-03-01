<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "AICE";

$myfile = fopen("temp/names.txt", "w");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM students ORDER BY name ASC;";
$result = $conn->query($sql);

$index = 0;

$data = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($data,array('name' => $row["name"],'wins' => $row["wins"],'score' => $row["score"])); 
        fwrite($myfile, $row["name"] . ",");
        $index++;
    }
}

fclose($myfile);

function build_table($array){

    // start table

    $html = '<table class="u-full-width">';

    // header row

    $html .= '<thead><tr><th> </th>';

    foreach($array[0] as $key=>$value){

            $html .= '<th>' . $key . '</th>';

        }
        if(empty( $array[0])){
            $html .= '<th>name</th><th>wins</th><th>score</th>';
        }

    $html .= '</tr></thead>';

    // data rows
    $index = 0;
    foreach( $array as $key=>$value){

        $html .= '<tbody><tr>';
        $html .= '<td><input name="checkbox_'.$index.'" type="checkbox"></td>';
        $count = 0;
        foreach($value as $key2=>$value2){
            if($count==0)
                $html .= '<td contenteditable="false">'.$value2.'<input name = "name_'.$index.'" type="hidden" value="' . $value2 . '"></td>';
            else if($count==1)
                $html .= '<td contenteditable="false"><input name = "wins_'.$index.'" type="text" value="' . $value2 . '"></td>';
            else
                $html .= '<td contenteditable="false"><input name = "score_'.$index.'" type="text" value="' . $value2 . '"></td>';
            $count++;
        }
        $index++;
        $html .= '</tr></tbody>';

    }
    
    $html .= '<tbody><tr>';
    $html .= '<td></td>';
    $html .= '<td contenteditable="false"><input name = "name_'.$index.'" type="text" placeholder="Student name..."></td>';
    $html .= '<td contenteditable="false"><input name = "wins_'.$index.'" type="text" placeholder="0" value="0"></td>';
    $html .= '<td contenteditable="false"><input name = "score_'.$index.'" type="text" placeholder="0" value="0"></td>';
    $html .= '</tr></tbody>';
    $GLOBALS['index'] = $index;

    // finish table and return it

    $html .= '</table>';

    return $html;

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
        
        <title>Student Manager</title>
    </head>
    <body>
        <br>
        <?php if (login_check($mysqli) == true) : ?>
        <div class="container">
          <div class="row">
            <div class="two columns">
                <a href="index.php"><img alt="Debate Logo" style="margin-top: 20px" width="100%" src="images/debaytelogo.png"></a>
            </div>
        </div>
        <div class="row">
            <div class="twelve columns">
                <h1 class="title" style="text-align: center;">Manage</h1>
            </div>
        </div>
            
            <form action="submit.php" method="post">
        <div class="row">
            <div class="three columns">
                <a href="uploadHandler.php" class="button button-primary" type="button">Upload Result</a>
            </div>
            <div class="two columns">
                <input class="button-primary" type="submit" value="Remove" name="remove">
            </div>
            <div class="five columns">
                <h1></h1>
            </div>
            <div class="two columns">
                <a href="includes/logout.php" class="button">Log out</a>
            </div>
        </div>
            
        <div class="row">
            <div class="twelve columns">
            <?php echo build_table($data); ?>
            </div>
        </div>
        <div class="row">
            <div class="two columns">
            <input class="button" type="submit" value="+ Add Student" name="add">
            </div>
            <div class="eight columns">
            <h1></h1>
            </div>
            <div class="two columns">
            <input class="button-primary" type="submit" value="Submit" name="submit">
            </div>
        </div>
                
        <input type="hidden" name="index" value="<?php echo $GLOBALS['index']?>" />
        <input type="hidden" name="update" value="up" />
        </form>
        </div>
        </div>
        
        <?php else : 
            header('Location: ../unauthorized.html');
        endif; ?>
    </body>
</html>