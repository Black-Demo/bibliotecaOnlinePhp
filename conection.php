<?php
    //Connect to database
    $conn = mysqli_connect('localhost', 'libraryStiven', 'contraseñasegura', 'library');
    //mysqli_set_charset($conn,CP_UTF8);
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>