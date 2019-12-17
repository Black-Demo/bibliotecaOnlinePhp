<?php 
    include 'header.php';
?>
    <div id="profile">
        <div class="user-identity">
            <i class="iconProfile">icon</i>
            <p class="emailUser"><?php echo $_SESSION['email'];?></p>
        </div>
        <div class="user-library-information">
            <p class="total-books">
                <?php echo $_SESSION['total_books']; ?> 
                Libros pendientes de devolución
            </p>
            <p class="penalty">
                Usted no podra reservar ningun libro hasta: 
                <?php 
                    echo $_SESSION['penalty'];
                ?>
            </p>
        </div>
    </div>
    <div id="borrows">
        <div class="pending">
            <p>Libros pendientes de devolucion:</p>
            <?php 
                $selectReserve = "SELECT book.*, date_reserve, date_end FROM reservation
                    INNER JOIN copy_book on Copybook_id = id_copyBook
                    INNER JOIN book on originalBook_id = book_id
                    WHERE user_id = '$_SESSION[userId]' and date_devolution is null";

                $varReserve = mysqli_fetch_all(mysqli_query($conn,$selectReserve), MYSQLI_ASSOC);

                foreach($varReserve as $reserve){
                    echo 'Titulo: '.htmlspecialchars($reserve['title']).'<br>';
                    echo 'Author: '.htmlspecialchars($reserve['author']).'<br>';
                    echo 'Editorial: '.htmlspecialchars($reserve['editorial']).'<br>';
                    echo 'Date get: '.htmlspecialchars($reserve['date_reserve']).'<br>';
                    echo 'Date max of devolution: '.htmlspecialchars($reserve['date_end']).'<br>';
                    echo '<br>';
                }
            ?>
        </div>
    </div>
<?php
    include 'footer.php';
?>