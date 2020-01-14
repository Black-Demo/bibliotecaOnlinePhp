<?php 
    require '../includes/conection.php';
    
    if (isset($_POST['insert_member'])){
        $varEmail = mysqli_real_escape_string($conn,$_POST['email']);
        $varPassw = mysqli_real_escape_string($conn,$_POST['pwd']);
        $varPasswRe = mysqli_real_escape_string($conn,$_POST['repeat-pwd']);
        $varName = mysqli_real_escape_string($conn,$_POST['name']);
        $varLastname1 = mysqli_real_escape_string($conn,$_POST['lastName1']);
        $varLastname2 = mysqli_real_escape_string($conn,$_POST['lastName2']);
        $varDNI = mysqli_real_escape_string($conn,$_POST['dni']);
        $varPhone = mysqli_real_escape_string($conn,$_POST['phone']);
        $varNumPostal = mysqli_real_escape_string($conn,$_POST['numPostal']);

        if(empty($varEmail) || empty($varPassw) || empty($varPasswRe)
            || empty($varName) || empty($varLastname1) || empty($varLastname2)
            || empty($varDNI) || empty($varPhone) || empty($varNumPostal)){
                header("Location: ../form_singUp_member.php?error=emptyfield&email=".$varEmail."&name=".$varName."&lastname1=".$varLastname1.
                "&lastname2=".$varLastname2."&dni=".$varDNI."&phone=".$varPhone.
                "&numPostal=".$varNumPostal);
            exit();
        }else if(!filter_var($varEmail, FILTER_VALIDATE_EMAIL)){
            header("Location: ../form_singUp_member.php?error=errorEmial&name=".$varName."&lastname1=".$varLastname1.
                "&lastname2=".$varLastname2."&dni=".$varDNI."&phone=".$varPhone.
                "&numPostal=".$varNumPostal);
            exit();
        }else if($varPassw !== $varPasswRe){
            header("Location: ../form_singUp_member.php?error=passwordcheckd&email=".$varEmail."&name=".$varName."&lastname1=".$varLastname1.
                "&lastname2=".$varLastname2."&dni=".$varDNI."&phone=".$varPhone.
                "&numPostal=".$varNumPostal);
            exit();
        }else if(strlen($varNumPostal)>5){
            header("Location: ../form_singUp_member.php?error=postalNumber");
        }else{
            $sqlInsertMember = "INSERT INTO members (
                name,
                lastname1,
                lastname2,
                e_mail,
                password_user,
                dni,
                phone,
                postalNumber
            ) values (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sqlInsertMember)){
                header("Location: ../form_signUp_member.php?error=sqlError");
            }else{
                $hashPwd = password_hash($varPassw, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ssssssss",
                 $varName,$varLastname1,$varLastname2,$varEmail,$hashPwd,$varDNI,$varPhone,$varNumPostal);
                
                mysqli_stmt_execute($stmt);
                header("Location: ../form_signUp_member.php?success=singup");
                exit();
            }
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }else{
        header("Location: ../form_signUp_member.php");
        exit();
    }