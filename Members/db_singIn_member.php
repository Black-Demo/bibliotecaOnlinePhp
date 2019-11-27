<?php
    require '../conection.php';
    if(isset($_POST['logIn'])){
        $varEmailUid = mysqli_real_escape_string($conn,$_POST['email']);
        $varPwd = mysqli_real_escape_string($conn,$_POST['passw']);
        if(empty($varEmailUid) || empty($varPwd)){
            header("Location: form_singIn_member.php?error=emptyfileds");
            exit();
        }else{
            $selectMember = "SELECT * FROM memebers WHERE email = ?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$selectMember)){
                header("Location: form_singIn_member.php?error=sqlError");
                exit();
            }else{
                mysqli_stmt_bind_param($stmt,"ss",$varEmailUid,$varPwd);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($varPwd, $row['password_user']);
                    if($pwdCheck == false){
                        header("Location: form_singIn_member.php?error=wrongPwd");
                        exit();
                    }else if($pwdCheck == true){
                        session_start();
                        $_SESSION['userId'] = $row['member_id'];
                        $_SESSION['userDni'] = $row['dni'];
                        $_SESSION['librarian'] = $row['librarian'];

                        header("Location: ../indexHomePage.php?login=success");
                        exit();
                    }else{
                        header("Location: form_singIn_member.php?error=wrongPwd");
                        exit();
                    }
                }else{
                    header("Location: form_singIn_member.php?error=noUser");
                    exit();
                }

            }
        }
    }else{
        header("Location: form_singIn_member.php");
         exit();
    }
    
?>