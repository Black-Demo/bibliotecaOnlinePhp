<?php
    include 'GlobalsVariables.php';
    echo "
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
        <select name='theme' id='theme'>";
        for($i=0; $i < sizeof($themeArray);$i++)
            echo "<option value=$themeArray[$i]>$themeArray[$i]</option>";
        echo "
        </select>
        <br><br>

        <label for='category'>Category:</label>
        <select name='category' id='category'>
            <optgroup label='liric'>";
            for($i = 0; $i<=6; $i++)
                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
        echo "
            </optgroup>
            <optgroup label='epic'>";
            for($i = 7; $i<=13; $i++)
                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
        echo "
            </optgroup>
            <optgroup label='dramatic'>";
            for($i = 14; $i<=19; $i++)
                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
        echo "
            </optgroup>
            <optgroup label='didactic'>";
            for($i = 20; $i<=23; $i++)
                echo "<option value=$categoryArray[$i]>$categoryArray[$i]</option>";
        echo "    
            </optgroup>
        </select>
        <br><br>
        <label for='language'>Language:</label>
        <select name='language' id='language'>";
        for($i = 0; $i<sizeOf($languagesArray); $i++)
        echo "<option value=$languagesArray[$i]>$languagesArray[$i]</option>";
        echo "
        </select>
        <br><br>
    </fieldset>
    <br>
    <input type='submit' value='Add Book' name='insert_book'>
</form>";
