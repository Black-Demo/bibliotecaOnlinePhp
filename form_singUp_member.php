<?php
    require 'header.php';
?>
<main>

    <div class="wrapper-main">
        <section class="section-default">
            <h1>Sing up</h1>
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']=="emptyfield"){
                            echo '<p class="singUp Error">Fill in all fields!</p>';
                        }
                        //else if(//El resto de errores)
                            
                    }else if($_GET['signup']=="sucess"){
                        echo '<p class="sucessLogin">SUCCESS</p>';
                    }
                ?>
            <form action="Members/db_singUp_member.php" method='POST' class="form singup">
                <div class="form singup userId">
                    <input type="email" name="email" id="email" placeholder="email">
                    <input type="password" name="pwd" id="pwd" placeholder="password">
                    <input type="password" name="repeat-pwd" id="repeat-pwd" placeholder="repeat password">
                </div>
                <div class="form singup dni">
                    <input type="text" name="dni" id="dni" placeholder="DNI/NIE">
                </div>
                <div class="form-singup-TotalName">
                    <input type="text" name="name" id="name" placeholder="name">
                    <input type="text" name="lastName1" id="lastName1" placeholder="firts lastname">
                    <input type="text" name="lastName2" id="lastName2" placeholder="second lastname">
                </div>
                <div class="form singup phone">
                    <input type="tel" name="phone" id="phone" placeholder="telefon number">
                </div>
                <div class="form singup diretion">
                    <input type="number" name="numPostal" id="numPostal" placeholder="zip number">
                </div>
                
                
 
                <button type='submit' name='insert_member'>Sing up</button>
            </form>
        </section>
    </div>
    
<main>
<?php
    require 'footer.php';
?>