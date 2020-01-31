<?php
    include 'includes/GlobalsVariables.php';
?>

<form method='POST' action='Books/db_insert_book.php' class="singup-form" enctype="multipart/form-data">
    <h1>Insert Book</h1>
    <!--Form for add books to the galery-->
    
    <div class="txtb">
        <input type="number" name="pos" id="pos">
        <span data-placeholder="Position"></span>
    </div>
    <div class="txtb">
        <input type="text" name="title" id="title">
        <span data-placeholder="Title"></span>
    </div>
    <div class="txtb">
        <input type="text" name="author" id="author">
        <span data-placeholder="Author"></span>
    </div>
    <div class="txtb">
        <input type='text' name='editorial' id='editorial'>
        <span data-placeholder="Editorial"></span>
    </div>
    <div class="txtb">
        <input type= 'number' name='isbn' id='isbn'>
        <span data-placeholder="ISBN"></span>
    </div>

    <label for='theme'>Theme:</label>
    <select name='theme' id='theme'>
        <?php for($i=0; $i < sizeof($themeArray);$i++){ 
            echo "<option value=$themeArray[$i]> $themeArray[$i]</option>";
        } ?>
    </select>

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
    <label for='language'>Language:</label>
    <select name='language' id='language'>
        <?php for($i = 0; $i<sizeOf($languagesArray); $i++){
            echo "<option value=$languagesArray[$i]>$languagesArray[$i]</option>";
        } ?>
    </select>
    <div class="txtb">
        <input step="0.01" type="number" name="price" id="price" >
        <span data-placeholder="Price"></span>
    </div>

    <input type="file" name="imgBook" id="imgBook">
        
    <br>
    <input type='submit' value='Add Book' name='insert_book' class='btnA'>
</form>
