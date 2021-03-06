<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

if (isset($_POST['cancel'])){
    echo $_POST['action'];
    cleanUp();
    header('Location: ../index.php');
}

if(login_check($mysqli) == false){
    header('Location: ../unauthorized.php');
}
else{
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "AICE";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Store info into database
    if (isset($_POST['index']) and !isset($_POST['cancel'])){
        $update = isset($_POST['update']);
        $remove = isset($_POST['remove']);
        if(isset($_POST['add'])){
            $_POST['name_'.$_POST['index']] = cleanString($_POST['name_'.$_POST['index']]);
            $_POST['wins_'.$_POST['index']] = cleanNumbers($_POST['wins_'.$_POST['index']]);
            $_POST['score_'.$_POST['index']] = cleanNumbers($_POST['score_'.$_POST['index']]);
            $sql = "INSERT INTO `students` (hash,name,wins,score) VALUES ('".hash('sha512',$_POST['name_'.$_POST['index']])."','".$_POST['name_'.$_POST['index']]."',".$_POST['wins_'.$_POST['index']].",".$_POST['score_'.$_POST['index']].");";
            $result = $conn->query($sql);
        }else{
            for($x = 0;$x<$_POST['index'];$x++){
                $names = explode(" ",$_POST['name_'.$x]);
                $_POST['name_'.$x] = cleanString($_POST['name_'.$x]);
                $_POST['wins_'.$x] = cleanNumbers($_POST['wins_'.$x]);
                $_POST['score_'.$x] = cleanNumbers($_POST['score_'.$x]);
                $sql = "SELECT hash,name,wins,score FROM `students` WHERE name='".$_POST['name_'.$x]."' LIMIT 1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                if($remove){
                    if(isset($_POST['checkbox_'.$x]) ){
                        $sql = "DELETE FROM `students` WHERE name='".$_POST['name_'.$x]."';";
                        $result = $conn->query($sql);
                    }
                }else{
                    if(!$update){
                        $newwins = $row['wins']+$_POST['wins_'.$x];
                        $newscore = $row['score']+$_POST['score_'.$x];
                    }else{
                        $newwins=$_POST['wins_'.$x];
                        $newscore=$_POST['score_'.$x];
                    }
                    if ($result->num_rows > 0) {
                        //Update info
                        $row = $result->fetch_assoc();
                        $sql1 = "UPDATE `students` SET wins='".$newwins."' WHERE hash='".hash('sha512',$_POST['name_'.$x])."';";
                        $sql2 = "UPDATE `students` SET score='".$newscore."' WHERE hash='".hash('sha512',$_POST['name_'.$x])."';";
                        $result = $conn->query($sql1);
                        $result = $conn->query($sql2);
                    } else {
                        $sql = "INSERT INTO `students` (hash,name,wins,score) VALUES ('".hash('sha512',$_POST['name_'.$x])."','".$_POST['name_'.$x]."',".$_POST['wins_'.$x].",".$_POST['score_'.$x].");";
        
                        $result = $conn->query($sql);
                    }
                }
            }
        }
    }
}
cleanUp();

header('Location: ../manageStudents.php');

//Clean Up!!!
function cleanUp(){
    $files = glob('temp/*'); // get all file names
    foreach($files as $file){ // iterate files
        if(is_file($file))
        unlink($file); // delete file
    }
}

function cleanString($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.

   return str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
}

function cleanNumbers($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^0-9]/', '', $string); // Removes special chars.
   if(empty($string)){
       return 0;
   }else{
       return $string;
   }
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
