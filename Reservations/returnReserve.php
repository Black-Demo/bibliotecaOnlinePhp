<?php
    include '../includes/conection.php';

    function calculatepenalty($date_end,$date_devolution,$penalty){
        $fechaActual = new DateTime($penalty);
        //echo date_diff($date_devolution,new DateTime($date_end));
        if($date_devolution >= $fechaActual) 
            return date_format(new DateTime(),'Y-m-d');
        else
            return date_format(($fechaActual->add(date_diff(new DateTime($date_end),$date_devolution))),'Y-m-d');
    }

    if(isset($_POST['return'])){
        $sqlReturnReserve = "UPDATE reservation set date_devolution = current_timestamp() 
            wHERE Copybook_id = '$_POST[Copybook_id]' AND user_id ='$_POST[user_id]'";
        if (!$conn->query($sqlReturnReserve)) {
            echo '<br>Devolution Book error: ' . mysqli_error($conn);
            header ('Location: ../Devolution.php?error=devolutionUpdate');
            exit();
        }

        $sqlReturnBook= "UPDATE copy_book set reserved = 0 where id_copyBook='$_POST[Copybook_id]'";
        if(!$conn->query($sqlReturnBook)) {
            echo '<br>Return Book error: ' . mysqli_error($conn);
            header ('Location: ../Devolution.php?error=updateBook');
            exit();
        }

        $selectActualPenalty = "SELECT penalty from members where member_id='$_POST[user_id]'";
        $penalty = mysqli_fetch_assoc(mysqli_query($conn,$selectActualPenalty));

        if($penalty['penalty']!=null){
            $penaltyDate = calculatepenalty($_POST['date_end'],new DateTime(),$penalty['penalty']);
            $sqlPenalty = "UPDATE members set penalty = '$penaltyDate' WHERE member_id='$_POST[user_id]'";
        }else{
            $penaltyDate = calculatepenalty($_POST['date_end'],new DateTime(),'NOW');
            $sqlPenalty = "UPDATE members set penalty = '$penaltyDate' WHERE member_id='$_POST[user_id]'";
        }
        
        
        
        if(!$conn->query($sqlPenalty)) {
            echo '<br>Update penalty error: ' . mysqli_error($conn);
            header ('Location: ../Devolution.php?error=penaltyNoAdd');
            exit();
        }

        $uptateTotalBook = "UPDATE members set total_books_reserved = (total_books_reserved-1) where member_id='$_POST[user_id]'";
        if(!$conn->query($uptateTotalBook)) {
            '<br>Update total_book error: ' . mysqli_error($conn);
            header ('Location: ../Devolution.php?error=totalBook');
            exit();
        }


        header('Location: ../Devolution.php?succes=returnBook');
        exit();
    }
?>