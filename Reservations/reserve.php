<?php
session_start();
include '../conection.php';
if (isset($_POST['Reservation'])) {

    $sqlCopyIdBook = "SELECT id_copyBook FROM copy_book
        WHERE languages = '$_POST[languages]' AND originalBook_id = '$_POST[idBook]'
        AND available = 1 AND reserved = 0 Limit 1";
    $varIdCopy = mysqli_fetch_assoc(mysqli_query($conn, $sqlCopyIdBook));

    
    $sqlInsertReserve = "INSERT INTO reservation(
        Copybook_id,
        member_id
    ) VALUES(?,?)";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sqlInsertReserve))
        header ("Location: ../index.php?error=reserveError");
    else{
        mysqli_stmt_bind_param($stmt,'ss',$varIdCopy['id_copyBook'],$_SESSION['userId']);
        mysqli_stmt_execute($stmt);

        //Poner la fecha de entrega para un mes despues de la reserva
        $sqlUpdatereserve = "UPDATE reservation SET date_end = date_add(date_at,interval 1 month)
        WHERE Copybook_id = '$varIdCopy[id_copyBook]' AND member_id = '$_SESSION[userId]'";
        if(!$conn->query($sqlUpdatereserve)){
            header("Location: ../index.php?error=insertDateEnd");
            exit();
        }
        //Poner un libro como reservado
        $sqlUpdateCopybook = "UPDATE copy_book SET reserved = 1 WHERE id_copyBook = '$varIdCopy[id_copyBook]'";
        if(!$conn->query($sqlUpdateCopybook)){
            header("Location: ../index.php?error=updateReserveBook");
            exit();
        }


        header("Location: ../index.php?resevation=success");
        exit();
    }
}
?>