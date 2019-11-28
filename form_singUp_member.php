<?php
    require 'header.php';
    /*if(isset($_GET['error'])){
        if($_GET['error']=="emptyfileds"){
            echo '<p class="singError">Fill in all fields!</p>';
        }
        //else if(//El resto de errores)
            
        }else if($_GET['login']=="sucess"){
            echo '<p class="sucessLogin">SUCCESS</p>';
        }
*/?>
<main>

    <div class="wrapper-main">
        <section class="section-default">
            <h1>Sing up</h1>
            <form action="Members/db_singUp_member.php" method='POST' class="form-singup">
                
                <input type="email" name="email" id="email" placeholder="email">
                <input type="password" name="pwd" id="pwd" placeholder="password">
                <input type="password" name="repeat-pwd" id="repeat-pwd" placeholder="repeat password">
                <br>
                <input type="text" name="name" id="name" placeholder="name">
                <input type="text" name="lastName1" id="lastName1" placeholder="firts lastname">
                <input type="text" name="lastName2" id="lastName2" placeholder="second lastname">
                <br>
                <input type="text" name="dni" id="dni" placeholder="DNI/NIE">
                <br>
                <input type="tel" name="phone" id="phone" placeholder="telefon number">
                <input type="number" name="numPostal" id="numPostal" placeholder="zip number">
 
                <button type='submit' name='insert_member'>Sing up</button>
            </form>
        </section>
    </div>
    
<main>
<?php
    require 'footer.php';
?>