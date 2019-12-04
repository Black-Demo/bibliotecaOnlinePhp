<?php
include '../conection.php';
include '../GlobalsVariables.php';
if (isset($_POST['Update'])) {
    $selectBook = "SELECT * FROM book 
            INNER JOIN copy_book ON book_id = originalBook_id
            WHERE book_id = '$_POST[idBook]' AND languages = '$_POST[languages]'
            LIMIT 1";

    $books = mysqli_fetch_all(mysqli_query($conn, $selectBook), MYSQLI_ASSOC);

    foreach ($books as $book) {
        ?>
        <form method='POST' action='db_update_book.php'>
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
        <?php
                echo "
        <label for='theme'>Theme</label>
        <select name='theme' id='theme'>";
                for ($i = 0; $i < sizeof($themeArray); $i++) {
                    if ($book['theme'] == $themeArray[$i])
                        echo "<option value=$themeArray[$i] selected>$themeArray[$i]</option>";
                    else
                        echo "<option value=$themeArray[$i]>$themeArray[$i]</option>";
                }
                echo "
    </select>
    <br><br>

    <label for='category'>Category:</label>
    <select name='category' id='category'>
        <optgroup label='liric'>";
                for ($i = 0; $i <= 6; $i++) {
                    if ($book['category'] == $categoryArray[$i])
                        echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                    else
                        echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                }
                echo "
        </optgroup>
        <optgroup label='epic'>";
                for ($i = 7; $i <= 13; $i++) {
                    if ($book['category'] == $categoryArray[$i])
                        echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                    else
                        echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                }
                echo "
        </optgroup>
        <optgroup label='dramatic'>";
                for ($i = 14; $i <= 19; $i++) {
                    if ($book['category'] == $categoryArray[$i])
                        echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                    else
                        echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                }
                echo "
        </optgroup>
        <optgroup label='didactic'>";
                for ($i = 20; $i <= 23; $i++) {
                    if ($book['category'] == $categoryArray[$i])
                        echo "<option value=$categoryArray[$i] selected >$categoryArray[$i]</option>";
                    else
                        echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
                }
                echo "    
        </optgroup>
    </select>
    <br><br>
    <label for='language'>Language:</label>
    <select name='language' id='language'>";
                for ($i = 0; $i < sizeOf($languagesArray); $i++) {
                    if ($book['languages'] == $languagesArray[$i])
                        echo "<option value=$languagesArray[$i] selected >$languagesArray[$i]</option>";
                    else
                        echo "<option value=$languagesArray[$i]>$languagesArray[$i]</option>";
                }
                echo "
    </select>
    <br><br>
</fieldset>
<br>
<input type='submit' value='Update Book' name='update_book'>
</form>";
            }
        } ?>