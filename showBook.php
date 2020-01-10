<?php

ini_set('include_path',$_SERVER['DOCUMENT_ROOT'].'/tuts/Biblioteca');

include 'header.php';

if (isset($_POST['select_book'])) {
    if (empty($_POST['book_search']))
        echo 'error texto vacio';

    $selectBook = "SELECT DISTINCT book_id,title,author,editorial,theme,category,languages FROM book 
            INNER JOIN copy_book ON book_id = originalBook_id
            WHERE title LIKE '%$_POST[book_search]%' AND available = 1 AND reserved = 0
            ORDER BY author ";

    $books = mysqli_fetch_all(mysqli_query($conn, $selectBook), MYSQLI_ASSOC);

    foreach ($books as $book) {
?>
            <div class="container">
                <div class="card">
                    <div class="imgBx" data-text="<?php echo htmlspecialchars($book['title']); ?>" >
                        <img src="#" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    </div>
                    <div class="content">
                        <div>
                            <h3><?php htmlspecialchars($book['title']) ?></h3>
                            <p>
                                <?php   echo 'Author: '.htmlspecialchars($book['author']).'<br>';
                                        echo 'Editorial: '.htmlspecialchars($book['editorial']).'<br>';
                                        echo 'Theme: '.htmlspecialchars($book['theme']).'<br>';
                                        echo 'Category: '.htmlspecialchars($book['category']).'<br>';
                                        echo 'Languages: '.htmlspecialchars($book['languages']).'<br>';
                                        if (isset($_SESSION['userId'])){ 
                                            if(strtotime($_SESSION['penalty'])< strtotime(date ("Y-m-d",time()))){
                                                echo "
                                                <div class='buttonBook'>
                                                    <!--If the user are register he can reserve-->
                                                    <form name='libro' method='POST' action='Reservations/reserve.php'>
                                                        <input type='hidden' id='idBook' name='idBook' value='$book[book_id]'>
                                                        <input type='hidden' id='languages' name='languages' value='$book[languages]'>
                                                        <input type='submit' name='Reservation' value='Reservation' class='btn-blue'>
                                                    </form>
                                                    <!--If the user are the librarian he can delete and update a book-->";
                                            }
                                            if($_SESSION['librarian']=='1'){
                                                echo "
                                                    <form name='libro' method='POST' action='form_update_book.php'>
                                                        <input type='hidden' id='idBook' name='idBook' value='$book[book_id]'>
                                                        <input type='hidden' id='languages' name='languages' value='$book[languages]'>
                                                        <input type='submit' name='Update' value='Update' class='btn-green'>
                                                    </form>
                                                    <form name='libro' method='POST' action='Books/db_delete_book.php' class='form delete book'>
                                                        <input type='hidden' id='idBook' name='idBook' value='$book[book_id]'>
                                                        <input type='hidden' id='languages' name='languages' value='$book[languages]'>
                                                        <input type='submit' name = 'Delete' value='Delete' class='btn-red'>
                                                    </form>
                                                </div>";
                                            } 
                                        }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
<?php
    }
}?>
