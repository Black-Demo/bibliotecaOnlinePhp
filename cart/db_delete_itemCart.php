<?php
    include '../includes/conection.php';
    $id = $_POST['id'];

    //echo json_encode($id);

    $DeletedCartItem = "UPDATE cart_product SET deleted = 1 WHERE id_product = '$id'";

    if (!$conn->query($DeletedCartItem)) {
        echo json_encode('Deleted cart product error: ' . mysqli_error($conn));
        exit();
    }

?>