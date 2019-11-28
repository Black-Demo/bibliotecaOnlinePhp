<?php
    session_start();
    $access_type=$_SESSION['librarian'] ?? 'guest';
    echo $access_type;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Library-Test</title>
    </head>
    <?php require 'header.php';
        include 'Books/form_select_book.php';
    switch($access_type){
        case '1': include 'Books/form_insert_book.php'; break;
        case '0': include ''; break;
    }




/*
        if(isset($_SESSION['userId'])){
            if($_SESSION['librarian'] == 1){
                include 'Books/form_insert_book.php';
            }
        }
        */
        
        ?>
    <br>
    <?php require 'footer.php' ?>
</html>