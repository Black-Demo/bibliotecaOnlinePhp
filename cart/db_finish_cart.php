<?php

include '../includes/conection.php';

$title = $_POST['title'];
$quantity = intval($_POST['quantity']);
$result;

$today = date_format(new DateTime(),'Y-m-d');

$selectBookInfo  = "SELECT count(cart_id) as total,cart_id, id_product, book.quantity 
    FROM cart_product INNER JOIN book ON book_id = id_product
     WHERE book.title = ? && deleted = '0' group by cart_id";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $selectBookInfo)) {
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $actualQuantity = $row['quantity']-$quantity;
        
        $updateCart = "UPDATE cart SET
            date_end = '$today',
            finished = 1,
            total_products = '$row[total]'
        WHERE id_cart = '$row[cart_id]'";
        mysqli_query($conn, $updateCart);

        $UpdateBook = "UPDATE book SET 
            quantity = '$actualQuantity'
        WHERE book_id = '$row[id_product]'";
        mysqli_query($conn, $UpdateBook);

        $updateCopysBook = "UPDATE copy_book SET 
            available = 0
        WHERE id_copyBook IN (
            SELECT * FROM (SELECT id_copyBook FROM copy_book WHERE originalBook_id = '$row[id_product]' AND available = 1
            ORDER BY id_copyBook LIMIT $quantity) as id
        )";
        mysqli_query($conn, $updateCopysBook);

        echo json_encode("yes");    
    }else{
        echo json_encode("error");
    }
}


?>