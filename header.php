<?php
     session_start();
?>
<!DOCTYPE html>
<html>
     <head>          
          <title></title>
          <link rel="stylesheet" href="./style.css">
     </head>
     <body>
          <header>
               <nav class="nav-header-main">
                    <a href="#" class="header-logo">
                         <img src="img/logo.jpg" alt="logo">
                    </a>
                    <ul>
                         <li><a href="index.php">Home</a></li>
                         <li><?php include 'search_book.php' ?></li>
                         <li><a href="#">Some</a></li>
                    </ul>
                    <div class="header-login">
                    <?php  if(!isset($_SESSION['userId'])){ ?>
                         <form action="Members/db_singIn_member.php" method="post">
                              <input type="text" name="mailuid" placeholder="E-mail...">
                              <input type="password" name="pwd" placeholder="Password...">
                              <button type="submit" name="login-submit">Login</button>
                         </form>
                    <?php } ?>
                         <a href="form_singUp_member.php">Sing Up</a>
                         <form action="Members/session_logOut_member.php" method="post">
                              <button type="submit">Log out</button>
                         </form>
                    </div>
               </nav>
          </header>