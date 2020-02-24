<?php

include '../includes/conection.php';

$title = $_POST['title'];
$quantity = $_POST['quantity'];
$result;

$today = date_format(new DateTime(),'Y-m-d');

$selectBookInfo  = "SELECT count(cart_id) as total,cart_id, id_product FROM cart_product WHERE title = ? && deleted = '0' group by cart_id";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $selectBookInfo)) {
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
           $updateCart = "UPDATE cart SET
               date_end = '$today',
               finished = 1,
               total_products = '$row[total]'
            WHERE id_cart = '$row[cart_id]'";
            if ($conn->query($UpdateBook)) {
                echo 'UPDATE cart';
            }else{
                echo json_encode("ERROR update");
            }

            $updateBook = "UPDATE book SET quantity = quantity-1
                WHERE book_id  = '$row[id_product]'
            ";
            
        
    }else{
        echo json_encode("nop");
    }
}


?>