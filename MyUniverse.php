<?php 
    include 'header.php';
    include 'DateReserve.php';

    $sqlReserve = "SELECT date_reserve, date_devolution, date_end FROM reservation
        WHERE member_id = '$_SESSION[userId]'";
        
    $dateReserved = new DateReserve();

?>
    <div id="profile">
        <div class="user-identity">
            <i class="iconProfile">icon</i>
            <p class="emailUser"><?php echo $_SESSION['email'];?></p>
        </div>
        <div class="user-library-information">
            <p class="total-books">
                <?php echo $_SESSION['total_books']; ?> 
                Libros pendientes de devolver
            </p>
            <p class="penalty">
                Usted no podra reservar ningun libro hasta: 
                <?php  ?>
            </p>
        </div>
    </div>
    <div id="borrows">
        <div class="pending">
            <?php 
            ?>
        </div>
        <div class="safe">

        </div>
    </div>
<?php
    include 'footer.php';
?>