<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

$file = "temp/output.txt";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css" type="text/css">
        <link rel="stylesheet" href="css/skeleton.css" type="text/css">
        <meta charset="utf-8" />
        <title>Confirm Submission</title>
    </head>
    <body>
        
        <?php if (login_check($mysqli) == true) : ?>
        <?php if (file_exists($file)) : ?>
            <h1 class="title" style="text-align: center;">Confirm</h1>
            <div class="container">
                </div>
            <div class="row">
             <div class="six columns">
            <script type="text/javascript">screen.width;</script>
            <img src='temp/tempImage.jpg' class ="u-max-full-width" alt ="Score Sheet" width="100%"   />
            </div>
            <div class="six columns">
            <form action="submit.php" method="post">
            <?php
            $names = explode(",",file_get_contents($file));
            $index = 0;
            $empty = FALSE;
            if($names[0]=="")
                $empty=TRUE;
            if(!$empty){
            foreach($names as $info){
                $exploded_info = explode(":",$info);
                $name = $exploded_info[0];
                $wins = $exploded_info[2];
                $score = 0;
                echo '<div class="row">';
                echo '<div class="four columns">';
                echo '<label for = "name">Name</label>';
                echo '<input class = "u-full-width" type="text" name="name_'.$index.'" value="' . $name . '">';
                echo '</div>';

                echo '<div class="two columns">';
                echo '<label for = "wins">Wins</label>';
                echo '<input class = "u-full-width" type="text" name="wins_'.$index.'" value="' . $wins .'">';
                echo '</div>';
                
                echo '<div class="two columns">';
                echo '<label for = "score">Score</label>';
                echo '<input class = "u-full-width" type="text" name="score_'.$index.'" value="' . $score . '">';
                
                echo '</div>';

                

                echo '</div>';
                $index+=1;
            }}else{
                echo 'No Data Read!<br>';
                echo '<a href="manageStudents.php" class="button button-primary">Go Back</a>';
            }?>
            <?php if(!$empty):?>
            <input type="hidden" name="index" value="<?php echo $index?>" />
            <input type="submit" value="CANCEL" name="cancel">
            <input class="button-primary" type="submit" value="SUBMIT" name="submit">
            <?php endif; ?>
            </form>
            </div>
            </div>
            </div>
        <?php else : ?>
            <div class="container" style="text-align: center;">
                <h1 class="tite">OOPS!</h1>
                <p>
                <span class="error">Something wrong happened.</span> <a href="index.php">Go back</a>.
                </p>
            </div>
        <?php endif; ?>
        
        <?php else : 
            header('Location: ../unauthorized.html');
        endif; ?>
    </body>
</html>
