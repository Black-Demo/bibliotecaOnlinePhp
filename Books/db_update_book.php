<?php
include '../conection.php';
if (isset($_POST['update_book'])) {

    $varTitleBook = mysqli_real_escape_string($conn, $_POST['title']);
    $varAuthor = mysqli_real_escape_string($conn, $_POST['author']);
    $varEditorial = mysqli_real_escape_string($conn, $_POST['editorial']);
    $varTheme = mysqli_real_escape_string($conn, $_POST['theme']);
    $varCategory = mysqli_real_escape_string($conn, $_POST['category']);
    $varLanguage = mysqli_real_escape_string($conn, $_POST['language']);
    $varIdBook = mysqli_real_escape_string($conn, $_POST['idBook']);
    

    $UpdateBook = "UPDATE book
         SET title = '$varTitleBook',
         author = '$varAuthor',
         editorial = '$varEditorial',
         theme = '$varTheme',
         category = '$varCategory'
         WHERE book_id = '$varIdBook'";
         
    if (!$conn->query($UpdateBook)) {
        echo '<br>Update Book error: ' . mysqli_error($conn);
        header ('Location: ../index.php?error=UpdateBook');
        exit();
    }

    header('Location: ../index.php?success=updateBook');
    exit();
}
