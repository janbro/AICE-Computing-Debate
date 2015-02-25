<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

$file = "temp/output.txt";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Confirm Submission</title>
    </head>
    <body>
        <?php if (file_exists($file)) : 
            $names = explode(",",file_get_contents($file));
            foreach($names as $info){
                $exploded_info = explode(":",$info);
                $name = $exploded_info[0];
                $wins = $exploded_info[2];
                $score = 0;
                echo 'Name: <input type="text" name="name" value="' . $name . '">';
                
                echo ' Wins: <input type="text" name="wins" value="' . $wins .'">';

                echo ' Score: <input type="text" name="score" value="' . $score . '">';
                echo "</br>---For ".$exploded_info[1] . "</br></br>";
            }?>
       
            <form action="submit.php" method="get" enctype="text/plain">
            <input type="submit" value="SUBMIT" name="submit">
            <input type="submit" value="CANCEL" name="cancel">
            </form>
            <script type="text/javascript">screen.width;</script>
            <img src='temp/tempImage.jpg' alt ="Score Sheet" width="40%"  />
        <?php else : ?>
            <p>
                <span class="error">Woops, something wrong happened.</span> <a href="index.php">Go back</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
