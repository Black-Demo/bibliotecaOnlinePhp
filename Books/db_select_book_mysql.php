<?php
include '../conection.php';
if (isset($_POST['select_book'])) {
    if (empty($_POST['book_search']))
        echo 'error texto vacio';

    $selectBook = "SELECT * FROM book 
            INNER JOIN copy_book ON book_id = originalBook_id
            WHERE title = '$_POST[book_search]' AND available = 1 AND reserved = 0
            ORDER BY author";


    $books = mysqli_fetch_all(mysqli_query($conn, $selectBook), MYSQLI_ASSOC);

    foreach ($books as $book) {
        echo htmlspecialchars($book['title']);
        echo '<br>';
        echo htmlspecialchars($book['author']);
        echo '<br>';
        echo htmlspecialchars($book['editorial']);
        echo '<br>';
        echo htmlspecialchars($book['theme']);
        echo '<br>';
        echo htmlspecialchars($book['category']);
        echo '<br>';
        echo htmlspecialchars($book['languages']);
        echo '<br>';
        echo htmlspecialchars($book['addBookDate']);
        echo '<br>';
        echo "
            <form name='libro' method='POST' action='form_update_book.php'>
                <input type='hidden' id='idBook' name='idBook' value=$book[book_id]>
                <input type='hidden' id='idCopybook' name='idCopyBook' value=$book[id_copyBook]>
                <input type='submit' name='Update' value='Update'>
            </form>
            <form name='libro' method='POST' action='db_delete_book.php'>
                <input type='hidden' id='idBook' name='idBook' value=$book[book_id]>
                <input type='hidden' id='idCopybook' name='idCopyBook' value=$book[id_copyBook]>
                <input type='submit' name = 'Delete' value='Delete'>
            </form>
            <form name='libro' method='POST' action='../Reservations/reserve.php'>
                <input type='hidden' id='idCopybook' name='idCopyBook' value=$book[id_copyBook]>
                <input type='submit' name='Reservation' value='Reservation'>
            </form>
        ";
    }
}
