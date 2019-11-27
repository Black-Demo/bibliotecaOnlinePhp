<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Library-Test</title>
    </head>
    <?php require 'header.php';

        
        include 'Books/form_select_book.php';
        if(isset($_SESSION['librarian'])){
            include 'Books/form_insert_book.php';
        } ?>
    <br>
    <?php require 'footer.php' ?>
</html>