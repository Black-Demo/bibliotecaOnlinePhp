<?php
include '../conection.php';
if (isset($_POST['Reservation'])) {
    $varIdBook = mysqli_real_escape_string($conn, $_POST['idBook']);
    echo $varIdBook;
}
?>