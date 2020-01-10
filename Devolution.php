<?php 
    include 'header.php';
?>
<div class="buscadorUsuario">
    <?php 
        if(!(isset($_POST['searchDNI']))){
    ?>
        <form action="Devolution.php" method='POST' class="searchDNI-box">
            <input type="text" class="searchDNI-txt"  placeholder="Dni user" name="dni">
            <input type="submit" value="search" name="searchDNI" class="searchDNI-btn">
        </form>
    <?php 
        }else{
            $varDni = mysqli_real_escape_string($conn,$_POST['dni']);
            $SelectUser = "SELECT dni, name, date_reserve, date_end, title, languages, Copybook_id, user_id from members
                inner join reservation on member_id = user_id
                inner join copy_book on Copybook_id = id_copyBook
                inner join book on originalBook_id = book_id
                WHERE dni = '$varDni' and date_devolution is null";

            $user = mysqli_fetch_all(mysqli_query($conn,$SelectUser), MYSQLI_ASSOC);

            foreach($user as $userBook){
                echo 'the user '.$userBook['name'].' whit dni: '.$userBook['dni']
                    .'<br>Need to return '.$userBook['title'].' write in '.$userBook['languages']
                    .'<br>Reserved: '.$userBook['date_reserve'].' and time limit: '.$userBook['date_end'];
                echo "
                    <form name='libro' method='POST' action='Reservations/returnReserve.php'>
                        <input type='hidden' id='date_end' name='date_end' value='$userBook[date_end]'>
                        <input type='hidden' id='user_id' name='user_id' value='$userBook[user_id]'>
                        <input type='hidden' id='Copybook_id' name='Copybook_id' value='$userBook[Copybook_id]'>
                        <input type='submit' name='return' value='Return' class='btn'>
                    </form>";
                echo '<br>';
            }            
        }
    ?>
</div>
<?php include'footer.php' ?>

