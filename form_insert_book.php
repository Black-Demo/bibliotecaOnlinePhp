<?php
    include 'GlobalsVariables.php';
?>

<form method='POST' action='Books/db_insert_book_mysql.php'>
    <!--Form for add books to the galery-->
    <fieldset>
        <label for='pos'>Position:</label>
        <input type='number' name='pos' id='pos'>
        <br><br>

        <label for='title'>Title:</label>
        <input type='text' name='title' id='title'>
        <br><br>

        <label for='author'>Author:</label>
        <input type='text' name='author' id='author'>
        <br><br>

        <label for='editorial'>Editorial:</label>
        <input type='text' name='editorial' id='editorial'>
        <br><br>

        <label for='isbn'>ISBN:</label>
        <input type= 'number' name='isbn' id='isbn'>
        <br><br>

        <label for='theme'>Theme</label>
        <select name='theme' id='theme'>
        <?php for($i=0; $i < sizeof($themeArray);$i++){ 
            echo "<option value=$themeArray[$i]> $themeArray[$i]</option>";
        } ?>
        </select>
        <br><br>

        <label for='category'>Category:</label>
        <select name='category' id='category'>
            <optgroup label='liric'>
            <?php for($i = 0; $i<=6; $i++){ 
                echo "<option value=$categoryArray[$i]> $categoryArray[$i] </option>";
            } ?>
            </optgroup>
            <optgroup label='epic'>
            <?php for($i = 7; $i<=13; $i++){
                echo "<option value=$categoryArray[$i]> $categoryArray[$i] </option>";
            } ?>
            </optgroup>
            <optgroup label='dramatic'>
            <?php for($i = 14; $i<=19; $i++){ 
                echo "<option value=$categoryArray[$i]> $categoryArray[$i] </option>";
            } ?>
            </optgroup>
            <optgroup label='didactic'>
            <?php for($i = 20; $i<=23; $i++){
                echo "<option value=$categoryArray[$i]> $categoryArray[$i] </option> ";
            } ?>
            </optgroup>
        </select>
        <br><br>
        <label for='language'>Language:</label>
        <select name='language' id='language'>
        <?php for($i = 0; $i<sizeOf($languagesArray); $i++){
            echo "<option value=$languagesArray[$i]>$languagesArray[$i]</option>";
        } ?>
        </select>
        <br><br>
    </fieldset>
    <br>
    <input type='submit' value='Add Book' name='insert_book'>
</form>
