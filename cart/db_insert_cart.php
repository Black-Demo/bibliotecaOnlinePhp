<?php
    session_start();
    include '../includes/conection.php';

    if(isset($_POST['Buy'])){

        $sqlCopyIdBook = "SELECT id_copyBook, title, price FROM copy_book
            INNER JOIN book ON originalBook_id = book_id
            WHERE languages = '$_POST[languages]' AND originalBook_id = '$_POST[idBook]'
            AND available = 1 AND reserved = 0 Limit 1";
        $varCopyBook = mysqli_fetch_assoc(mysqli_query($conn, $sqlCopyIdBook));

        $deleteBook = "UPDATE copy_book
            SET available = 0
            WHERE languages = '$_POST[languages]' AND originalBook_id = '$_POST[idBook]' 
            AND available = 1
            LIMIT 1";

        $cartID = cart();

        $insertProduct = "INSERT INTO cart_product(
            id_product,
            title,
            quantity,
            cart_id
        ) VALUES (
            '$varCopyBook[id_copyBook]',
            '$varCopyBook[title]',
            '1',
            '$cartID'
        )";

        if(!mysqli_query($conn,$insertProduct)){
            echo '<br> INSERT product to the cart error: '.mysqli_error($conn);
            header("Location: ../index.php?error=insertProductBookIntocart");
            exit();
        }

        if(!$conn->query($deleteBook)){
            echo '<br>Delete CopyBook error: '.mysqli_error($conn);
            header ('Location: ../index.php?error=deleteBook');
            exit();
        }

        header("Location: ../index.php?success=success");
        exit();
    }

    function cart(){

        include '../includes/conection.php';
        
        $cart_finished = "SELECT count(*) as total ,id_cart  from cart where finished =  0";
        $totalCartsFinished = mysqli_fetch_assoc(mysqli_query($conn,$cart_finished));
        if($totalCartsFinished['total'] != 0){
            /**
             * ?See if you have a actual cart no finished 
             */
            $update_cart = "UPDATE cart 
                SET total_products = total_products+1 
                WHERE finished = 0";
            if (!$conn->query($update_cart)) {
                echo '<br>Update Cart error: ' . mysqli_error($conn);
                header ('Location: ../index.php?error=UpdateCart');
                exit();
            }
        }else{
            $sqlInsertCart = "INSERT INTO cart(
                id_user,
                total_products
            )VALUES(
                '$_SESSION[userId]',
                1
            )";

            if(!mysqli_query($conn,$sqlInsertCart)){
                echo '<br> INSERT book cart error: '.mysqli_error($conn);
                header("Location: ../index.php?error=insertCartBook");
                exit();
            }
        }
        return $totalCartsFinished['id_cart'];
    }

?>