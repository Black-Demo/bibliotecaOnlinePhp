<?php include '../includes/conection.php' ?>
<?php
        if(isset($_POST['insert_book'])){
                $varPos = mysqli_real_escape_string($conn,$_POST['pos']);
                $varTitleBook = mysqli_real_escape_string($conn, $_POST['title']);
                $varAuthor = mysqli_real_escape_string($conn, $_POST['author']);
                $varEditorial = mysqli_real_escape_string($conn, $_POST['editorial']);
                $varISBN = mysqli_real_escape_string($conn,$_POST['isbn']);
                $varTheme = mysqli_real_escape_string($conn, $_POST['theme']);
                $varCategory = mysqli_real_escape_string($conn, $_POST['category']);
                $varLanguage = mysqli_real_escape_string($conn, $_POST['language']);
                $varQuantity = mysqli_real_escape_string($conn, $_POST['quantity']);
                //isbnCorrect($varISBN);

                //Insert a book, if this have a reference into the table only insert the language
                //Id book whit the dates 
                if(!($varAuthor==""||$varTitleBook==""||$varTitleBook==""||$varAuthor==""||$varEditorial==""||$varISBN==""||$varPos=="")){
                        $sqlSelectIdBook = "SELECT book_id FROM book WHERE title = '$varTitleBook'";
                        $result = mysqli_query($conn, $sqlSelectIdBook);
                        $idBook = mysqli_fetch_assoc($result);

                        $sqlCountBook = "SELECT COUNT(*) as total FROM book  WHERE book_id = '$idBook[book_id]'";
                        $test = mysqli_query($conn, $sqlCountBook);
                        $numberBook = mysqli_fetch_assoc($test);

                        if($numberBook['total']==0){
                                $sqlInsertBook = "INSERT INTO book(
                                        location,
                                        title,
                                        author,
                                        editorial,
                                        ISBN,
                                        theme,
                                        category,
                                        quantity
                                )VALUES(
                                        '$varPos',
                                        '$varTitleBook',
                                        '$varAuthor',
                                        '$varEditorial',
                                        '$varISBN',
                                        '$varTheme',
                                        '$varCategory',
                                        '$varQuantity'
                                )";

                                if(!mysqli_query($conn,$sqlInsertBook)){
                                        echo ' insert book error: '.mysqli_error($conn);
                                        header("Location: ../index.php?error=insertBook");
                                        exit();
                                }

                                $sqlSelectIdBookNew = "SELECT book_id FROM book WHERE title = '$varTitleBook'";
                                $resultNew = mysqli_query($conn, $sqlSelectIdBookNew);
                                $idBookNew = mysqli_fetch_assoc($resultNew);

                                $sqlInsertCopyBook = "INSERT INTO copy_book(
                                        OriginalBook_id,
                                        languages,
                                        reserved,
                                        available

                                )VALUES(
                                        '$idBookNew[book_id]',
                                        '$varLanguage',
                                        '0',
                                        '1'
                                )";
                                for($i=0; $i<(intval($varQuantity)); $i++){
                                        if(!mysqli_query($conn,$sqlInsertCopyBook)){
                                                echo '<br>new ID insert CopyBook error: '.mysqli_error($conn);
                                                header("Location: ../index.php?error=insertCopybook");
                                                exit();
                                        }
                                }
                                

                                header("Location: ../index.php?success=book");
                                exit();
                                

                        }else{
                                $sqlInsertCopyBook = "INSERT INTO copy_book(
                                        OriginalBook_id,
                                        languages,
                                        reserved,
                                        available
                                )VALUES(
                                        '$idBook[book_id]',
                                        '$varLanguage',
                                        '0',
                                        '1'
                                )";
                                
                                for($i=0; $i<(intval($varQuantity)); $i++){
                                        if(!mysqli_query($conn,$sqlInsertCopyBook)){
                                                echo '<br> old ID insert CopyBook error: '.mysqli_error($conn);
                                                header("Location: ../index.php?error=insertCopyBook");
                                                exit();
                                        }
                                }

                                $sqlUpdateQuantity = "UPDATE book set quantity=(quantity+intval($varQuantity)) where book_id='$idBook[book_id]'";
                                if(!$conn->query($sqlUpdateQuantity)) {
                                        echo'<br>Update quantity error: ' . mysqli_error($conn);
                                        header ('Location: ../Devolution.php?error=quantity');
                                        exit();
                                }

                                header("Location: ../index.php?success=book");
                                exit();
                        }
                }else{
                        mysqli_close($conn);
                        header("Location: ../index.php?error=emptyValue");
                        exit();
                }
        }
        //conection close
        


        //serach if the isbn is correct

        function isbnCorrect($isbn){

                $isbn = strval($isbn);
                $total = 0;
                if(strlen($isbn)!=10){
                        header("Location: ../index.php?error=ISBNLength");
                        exit();
                } 
                else{
                        for($i = 1; $i<=strlen($isbn); $i++){
                                $total += intval($isbn[$i-1])*$i;
                         }
                         if($total%11 == 0)return true;
                         else{
                                header("Location: ../index.php?error=notISBN");
                                exit();
                         }
                }

        }
?>
