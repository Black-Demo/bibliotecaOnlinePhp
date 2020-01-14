<?php require 'header.php'; ?>
            <form action="Members/db_signUp_member.php" method='post' class="singup-form">
            <?php if(isset($_GET['error'])){
                if($_GET['error']=="emptyfield"){
                    echo '<p class="singUp Error">Fill in all fields!</p>';
                }
                        //else if(//El resto de errores)     
            }?>
                <h1>Sign up</h1>
                <div class="userId">
                    <div class="txtb">
                        <input type="email" name="email">
                        <span data-placeholder="E-mail"></span>
                    </div>
                    <div class="txtb">
                        <input type="password" name="pwd">
                        <span data-placeholder="Password"></span>
                    </div>
                    <div class="txtb">
                        <input type="password" name="repeat-pwd">
                        <span data-placeholder="Repeat the password"></span>
                    </div>
                </div>
                <div class="txtb">
                    <input type="text" name="dni">
                    <span data-placeholder="DNI/NIE"></span>
                </div>
                <div class="totalName">
                    <div class="txtb">
                        <input type="text" name="name">
                        <span data-placeholder="Name"></span>
                    </div>
                    <div class="txtb">
                        <input type="text" name="lastName1">
                        <span data-placeholder="1º Lastname"></span>
                    </div>
                    <div class="txtb">
                        <input type="text" name="lastName2">
                        <span data-placeholder="2º Lastname"></span>
                    </div>
                </div>
                <div class="contact">
                    <div class="txtb">
                        <input type="number" name="phone">
                        <span data-placeholder="Telephone number"></span>
                    </div>
                    <div class="txtb">
                        <input type="number" name="numPostal">
                        <span data-placeholder="Zip number"></span>
                    </div>
                </div>
                <div class="singUpbtn">
                    <button type='submit' name='insert_member' class="singbtn">Register me</button>
                </div>
            </form>
            

<?php require 'footer.php'; ?>