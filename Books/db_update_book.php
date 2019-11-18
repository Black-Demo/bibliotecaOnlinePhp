<?php
include '../conection.php';
if (isset($_POST['update_book'])) {

    $varTitleBook = mysqli_real_escape_string($conn, $_POST['title']);
    $varAuthor = mysqli_real_escape_string($conn, $_POST['author']);
    $varEditorial = mysqli_real_escape_string($conn, $_POST['editorial']);
    $varTheme = mysqli_real_escape_string($conn, $_POST['theme']);
    $varCategory = mysqli_real_escape_string($conn, $_POST['category']);
    $varLanguage = mysqli_real_escape_string($conn, $_POST['language']);

    

    $sqlSelectIdBook = "SELECT book_id FROM book WHERE title = '$varTitleBook'";
    $idBook = mysqli_fetch_assoc(mysqli_query($conn, $sqlSelectIdBook));

    $sqlSelectIdCopyBook = "SELECT id_copyBook FROM copy_book 
    WHERE OriginalBook_id = '$idBook[book_id]' AND languages = '$varLanguage'";
     $idCopyBook = mysqli_fetch_assoc(mysqli_query($conn, $sqlSelectIdCopyBook));

    echo $idCopyBook['id_copyBook'];

    $UpdateBook = "UPDATE book
         SET title = '$varTitleBook',
         author = '$varAuthor',
         editorial = '$varEditorial',
         theme = '$varTheme',
         category = '$varCategory'
         WHERE book_id = '$idBook[book_id]'";
         
    if (!$conn->query($UpdateBook)) {
        echo '<br>Update Book error: ' . mysqli_error($conn);
    }

    $UpdateCopyBook = "UPDATE copy_book
         SET languages = '$varLanguage'
         WHERE id_copyBook = '$idCopyBook[id_copyBook]'";

    if (!$conn->query($UpdateCopyBook)) {
        echo '<br>Update copyBook error: ' . mysqli_error($conn);
    }
}
