<?php
    function logger($user,$error,$web){
        include 'conection.php';

echo $error;

        $insertError = "INSERT INTO log(
            user,
            text_log,
            error_place
        ) VALUES (
            '$user',
            '$error',
            '$web'
        )";


        if(!mysqli_query($conn,$insertError)){
            echo '<br> LOG ERROR: '.mysqli_error($conn);
            //header("Location: ../index.php");
            //exit();
        }

    }
?>