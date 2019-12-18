<?php
include 'header.php';
include 'includes/GlobalsVariables.php';
if (isset($_POST['Update'])) {    
    $selectBook = "SELECT * FROM book 
            INNER JOIN copy_book ON book_id = originalBook_id
            WHERE book_id = '$_POST[idBook]' AND languages = '$_POST[languages]'
            GROUP BY originalBook_id";

    $books = mysqli_fetch_all(mysqli_query($conn, $selectBook), MYSQLI_ASSOC);

    foreach ($books as $book) {?>
        <form method='POST' action='Books/db_update_book.php'>
            <!--Form for add books to the galery-->
            <fieldset>
                <label for='title'>Title:</label>
                <input type='text' name='title' id='title' value=<?php echo $book['title'] ?>>
                <input type="hidden" name="idBook" id="idBook" value=<?php echo $book['book_id'] ?>>
                <br><br>

                <label for='author'>Author:</label>
                <input type='text' name='author' id='author' value=<?php echo $book['author'] ?>>
                <br><br>

                <label for='editorial'>Editorial:</label>
                <input type='text' name='editorial' id='editorial' value=<?php echo $book['editorial'] ?>>
                <br><br>
         
                <label for='theme'>Theme</label>
                <select name='theme' id='theme'>";
                <?php 
                        for ($i = 0; $i < sizeof($themeArray); $i++) {
                            if ($book['theme'] == $themeArray[$i])
                                echo "<option value=$themeArray[$i] selected>$themeArray[$i]</option>";
                            else
                                echo "<option value=$themeArray[$i]>$themeArray[$i]</option>";
                        }
                ?>
            </select>
            <br><br>

            <label for='category'>Category:</label>
            <select name='category' id='category'>
                <optgroup label='liric'>";
                <?php
                        for ($i = 0; $i <= 6; $i++) {
                            if ($book['category'] == $categoryArray[$i])
                                echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                            else
                                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                        }
                ?>
                </optgroup>
                <optgroup label='epic'>";
                <?php
                        for ($i = 7; $i <= 13; $i++) {
                            if ($book['category'] == $categoryArray[$i])
                                echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                            else
                                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                        }
                ?>
                </optgroup>
                <optgroup label='dramatic'>";
                    <?php
                        for ($i = 14; $i <= 19; $i++) {
                            if ($book['category'] == $categoryArray[$i])
                                echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                            else
                                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                        }
                    ?>
                </optgroup>
                <optgroup label='didactic'>";
                    <?php
                        for ($i = 20; $i <= 23; $i++) {
                            if ($book['category'] == $categoryArray[$i])
                                echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                            else
                                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                        }
                        ?>    
                </optgroup>
            </select>
            <br><br>
        </fieldset>
        <br>
        <input type='submit' value='Update Book' name='update_book'>
</form>
<?php
    }
} ?>