<?php
    require 'header.php';
?>

    <main>
        <div class="wrapper main">
            <section class="section default">
                <?php
                    if(isset($_SESSION['userId'])){
                        if($_SESSION['librarian']=='1')
                            include 'form_insert_book.php';
                        else
                            echo '<p>You are logged in!</p>';
                    }else{
                        echo '<p>You are logged out!</p>';
                    }
                ?>
                
                
            </section>
        </div>
    </main>

<?php
    require 'footer.php';
?>