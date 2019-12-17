<?php
    require '../conection.php';
    if(isset($_POST['login-submit'])){
        $varEmailUid = mysqli_real_escape_string($conn,$_POST['mailuid']);
        $varPwd = mysqli_real_escape_string($conn,$_POST['pwd']);
        if(empty($varEmailUid) || empty($varPwd)){
            header("Location: ../index.php?error=emptyfileds");
            exit();
        }else{
            $selectMember = "SELECT * FROM members WHERE e_mail = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$selectMember)){
                header("Location: ../index.php?error=sqlError");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"s",$varEmailUid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($varPwd, $row['password_user']);
                    
                    if(!$pwdCheck){
                        header("Location: ../index.php?error=wrongPwd".$row['password_user']."-".$varPwd);
                        exit();
                    }else if($pwdCheck){
                        session_start();
                        $_SESSION['userId'] = $row['member_id'];
                        $_SESSION['email'] = $row['e_mail'];
                        $_SESSION['penalty'] = $row['penalty'];
                        $_SESSION['total_books'] = $row['total_books_reserved'];
                        $_SESSION['librarian'] = $row['librarian'];

                        header("Location: ../index.php?login=success");
                        exit();
                    }else{
                        header("Location: ../index.php?error=wrongPwdWHY");
                        exit();
                    }
                }else{
                    header("Location: ../index.php?error=noUser");
                    exit();
                }

            }
        }
    }else{
        header("Location: ../index.php");
         exit();
    }
    
?>