<?php include '../conection.php' ?>
<?php
        if(isset($_POST['insert_book'])){
                $varTitleBook = mysqli_real_escape_string($conn, $_POST['title']);
                $varAuthor = mysqli_real_escape_string($conn, $_POST['author']);
                $varEditorial = mysqli_real_escape_string($conn, $_POST['editorial']);
                $varTheme = mysqli_real_escape_string($conn, $_POST['theme']);
                $varCategory = mysqli_real_escape_string($conn, $_POST['category']);
                $varLanguage = mysqli_real_escape_string($conn, $_POST['language']);


//Insert a book, if this have a reference into the table only insert the language
                //Id book whit the dates 
                $sqlSelectIdBook = "SELECT book_id FROM book WHERE title = '$varTitleBook'";
                $result = mysqli_query($conn, $sqlSelectIdBook);
                $idBook = mysqli_fetch_assoc($result);

                $sqlCountBook = "SELECT COUNT(*) as total FROM book  WHERE book_id = '$idBook[book_id]'";
                $test = mysqli_query($conn, $sqlCountBook);
                $numberBook = mysqli_fetch_assoc($test);
                
                //echo $idBook['book_id'];

                if($numberBook['total']==0){
                        $sqlInsertBook = "INSERT INTO book(
                                title,
                                author,
                                editorial,
                                theme,
                                category
                        )VALUES(
                                '$varTitleBook',
                                '$varAuthor',
                                '$varEditorial',
                                '$varTheme',
                                '$varCategory'
                        )";

                        if(!mysqli_query($conn,$sqlInsertBook)){
                                echo ' insert book error: '.mysqli_error($conn);
                                header ('Locaction ../index.php?error=InsertBookError');
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

                        if(!mysqli_query($conn,$sqlInsertCopyBook)){
                                echo '<br>new ID insert CopyBook error: '.mysqli_error($conn);
                                header ('Locaction ../index.php?error=InsertCopyBookError');
                                exit();
                        }

                        header ('Locaction ../index.php?sucess=InsertBook');
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
        
                        if(!mysqli_query($conn,$sqlInsertCopyBook)){
                                echo '<br> old ID insert CopyBook error: '.mysqli_error($conn);
                                header ('Locaction ../index.php?error=InsertCopyBookError');
                                exit();
                        }
                        
                        header ('Locaction ../index.php?sucess=InsertBook');
                        exit();
                }

        }
        
        //conection close
        mysqli_close($conn);
        header ('Locaction ../index.php?sucess=InsertBook');
        exit();
?>
