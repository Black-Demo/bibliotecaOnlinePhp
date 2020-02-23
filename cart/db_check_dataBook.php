<?php
include '../includes/conection.php';

$id = $_POST['id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$selectBook = "SELECT price, quantity, title FROM book WHERE book_id = ?;";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $selectBook)) {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['quantity'] < $quantity || $row['price'] != $price) {
            $result->correct = "false";
            $result->id = $id;
            $result->title = $row['title'];
            $result->quantity = $row['quantity'];
            $result->price = $row['price'];

            echo json_encode($result);
        } else {
            echo json_encode("true");
        }
    }
}