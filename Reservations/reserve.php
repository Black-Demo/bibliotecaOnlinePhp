<?php
include '../conection.php';
if (isset($_POST['Reservation'])) {
    $varCopyIdBook = mysqli_real_escape_string($conn, $_POST['idCopyBook']);

    $sqlInsertReserve =  "INSERT INTO reservation(
        Copybook_id,
        member_id
    )VALUES(
        $varCopyIdBook,
        1
    )";

    if(!mysqli_query($conn,$sqlInsertReserve))
        echo ' insert reserve error: '.mysqli_error($conn);

    $sqlSelectInsertDate = "SELECT DATE_ADD(date_at, interval 1 month) as dateEnd from reservation";

    $dateEndReserve = mysqli_fetch_all(mysqli_query($conn, $sqlSelectInsertDate), MYSQLI_ASSOC);

    $sqlInsertReserveNew = "UPDATE reservation
    set date_end = $dateEndReserve[dateEnd]
    where Copybook_id = $varCopyIdBook";

if (!$conn->query($sqlInsertReserveNew)) {
    echo '<br>cosa Book error: ' . mysqli_error($conn);
}
}
?>