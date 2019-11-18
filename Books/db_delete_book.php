<?php
    include '../conection.php';
    if(isset($_POST['Delete'])){
        $deleteBook = "UPDATE copy_book
         SET available = 0
         WHERE id_copyBook = 'intval($_POST[idCopyBook])' AND originalBook_id = 'intval($_POST[idBook])'";

        if(!mysqli_query($conn,$deleteBook)){
            echo '<br>Delete CopyBook error: '.mysqli_error($conn);
        }
    }
?>