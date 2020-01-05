<?php
    include '../includes/conection.php';
    if(isset($_POST['Delete'])){
        $deleteBook = "UPDATE copy_book
         SET available = 0
         WHERE languages = '$_POST[languages]' AND originalBook_id = 'intval($_POST[idBook])' AND available = 1
         LIMIT 1";

        if(!$conn->query($deleteBook)){
            echo '<br>Delete CopyBook error: '.mysqli_error($conn);
            header ('Location: ../index.php?error=deleteBook');
            exit();
        }
        
        echo intval($_POST['idBook']).'#'.$_POST['languages'];

        /*header('Location: ../index.php?success=deleteBook');
        exit();*/
    }
?>