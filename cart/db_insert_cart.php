<?php
session_start();
include '../includes/conection.php';
include '../includes/Log.php';

if (isset($_POST['Buy'])) {

    $sqlCopyIdBook = "SELECT book_id,id_copyBook, title, price, img, author FROM copy_book
            INNER JOIN book ON originalBook_id = book_id
            WHERE languages = '$_POST[languages]' AND originalBook_id = '$_POST[idBook]'
            AND available = 1 AND reserved = 0 Limit 1";
    $varCopyBook = mysqli_fetch_assoc(mysqli_query($conn, $sqlCopyIdBook));

    cart();

    $cartID = chargeCart();

    product($cartID, $varCopyBook);

    //deleteBook();
    codified($varCopyBook['book_id'], $varCopyBook['title'], $varCopyBook['price'], 1, $varCopyBook['img'], $varCopyBook['author']);
}

function cart(){

    include '../includes/conection.php';

    $cart_finished = "SELECT count(*) as total, id_cart  from cart where finished =  0";
    $totalCartsFinished = mysqli_fetch_assoc(mysqli_query($conn, $cart_finished));
    if ($totalCartsFinished['total'] != 0) {
        /**
         * ?See if you have a actual cart no finished
         */
        $totalItemsCart = "SELECT count(*) as totalItems  from cart_product where cart_id = '$totalCartsFinished[id_cart]'";
        $totalProducts = mysqli_fetch_assoc(mysqli_query($conn, $totalItemsCart));

        $update_cart = "UPDATE cart
                SET total_products = '$totalProducts[totalItems]'
                WHERE finished = 0";
        if (!$conn->query($update_cart)) {
            echo '<br>Update Cart error: ' . mysqli_error($conn);
            header('Location: ../index.php?error=UpdateCart');
            exit();
        }
    } else {
        $sqlInsertCart = "INSERT INTO cart(
                id_user,
                total_products
            )VALUES(
                '$_SESSION[userId]',
                1
            )";

        if (!mysqli_query($conn, $sqlInsertCart)) {
            echo '<br> INSERT book cart error: ' . mysqli_error($conn);
            header("Location: ../index.php?error=insertCartBook");
            exit();
        }
    }

}

function product($cartID, $varCopyBook){
    include '../includes/conection.php';

    $item_cart = "SELECT count(*) as totalItems, deleted  from cart_product inner join cart on cart_id=id_cart where finished = 0";
    $totalItemCart = mysqli_fetch_assoc(mysqli_query($conn, $item_cart));
    if ($totalItemCart['totalItems'] == 0 || $totalItemCart['deleted'] == 1) {
        $insertProduct = "INSERT INTO cart_product(
                id_product,
                title,
                quantity,
                cart_id
            ) VALUES (
                '$varCopyBook[book_id]',
                '$varCopyBook[title]',
                '1',
                '$cartID'
            )";
        if (!mysqli_query($conn, $insertProduct)) {
            //$error = '"insert product to the cart error: ". mysqli_error($conn)';
            //logger($_SESSION['userId'],$error,$web);
            header("Location: ../index.php?error=insertProductBookIntocart");
            exit();
        }
    }

}

function chargeCart(){
    include '../includes/conection.php';
    $cart = "SELECT id_cart  from cart where finished =  0";
    $totalCart = mysqli_fetch_assoc(mysqli_query($conn, $cart));
    return $totalCart['id_cart'];
}

function deleteBook(){
    include '../includes/conection.php';

    $deleteBook = "UPDATE copy_book
            SET available = 0
            WHERE languages = '$_POST[languages]' AND originalBook_id = '$_POST[idBook]'
            AND available = 1
            LIMIT 1";

    if (!$conn->query($deleteBook)) {
        echo '<br>Delete CopyBook error: ' . mysqli_error($conn);
        header('Location: ../index.php?error=deleteBook');
        exit();
    }
}

function codified($id, $title, $price, $quantity, $img, $author){
    //$product = new stdObject();
    $product->id = $id;
    $product->img = $img;
    $product->title = $title;
    $product->quantity = $quantity;
    $product->price = $price;
    $product->user = $_SESSION['userId'];
    $product->author = $author;

    $JSONproduct = json_encode($product);
    echo "
            <script>
                localStorage.setItem('$id','$JSONproduct');
                window.location = '../shoppingCard.php';
            </script>
        ";
}