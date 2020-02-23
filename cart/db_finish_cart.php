<?php

include '../includes/conection.php';

$title = $_POST['title'];
$quantity = $_POST['quantity'];
$result;

$selectBookInfo  = "SELECT cart_id, id_product FROM cart_product WHERE title = ? && deleted = '0' group by cart_id";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $selectBookInfo)) {
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        
        
        
    }else{
        echo json_encode("nop");
    }
}


?>