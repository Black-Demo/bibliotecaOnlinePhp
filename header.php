<?php
     session_start();
     include 'conection.php';
?>
<!DOCTYPE html>
<html>
     <head>          
          <title></title>
          <link rel="stylesheet" href="./style.css">
     </head>
     <body>
          <header>
               <nav class="nav header main">
                    <a href="index.php" class="header-logo">
                         <img src="img/logo.jpg" alt="logo">
                    </a>
                    <ul>
                         <li><a href="index.php">Home</a></li>
                         <?php if(isset($_SESSION['userId'])){ ?>
                              <li><a href="myUniverse.php">My universe</a>
                                   <ul>
                                        <li><a href="MyUniverse.php#profile">Profile</a></li>
                                        <li><a href="MyUniverse.php#borrows">Borrows</a></li>
                                   </ul>
                              </li>
                         <?php } ?>
                         <li><?php include 'search_book.php' ?></li>
                    </ul>
                    <div class="header login">
                    <?php if(!isset($_SESSION['userId'])){ ?>
                         <form action="Members/db_singIn_member.php" method="post">
                              <input type="text" name="mailuid" placeholder="E-mail...">
                              <input type="password" name="pwd" placeholder="Password...">
                              <button type="submit" name="login-submit">Login</button>
                         </form>
                         <a href="form_singUp_member.php" class="sing-up-ref">Sing Up</a>
                    <?php }?>
                         <form action="Members/session_logOut_member.php" method="post" class="log out button">
                              <button type="submit">Log out</button>
                         </form>
                    </div>
               </nav>
          </header>