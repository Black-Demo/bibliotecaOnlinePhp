<?php
     session_start();
     include 'includes/conection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <link rel="stylesheet" href="./style.css">

    <script src="https://kit.fontawesome.com/101380c162.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js\formStyle.js" async></script>
</head>

<body>
    <header>
        <a href="index.php" class="logo">
            <img src="src/logos/logo.jpg" alt="logo">
        </a>
        <nav class="nav header main">
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if(isset($_SESSION['userId'])){ ?>
                <li><a href="myUniverse.php">My universe</a></li>
                <?php
                              if($_SESSION['librarian']=='1'){
                         ?>
                <li><a href="Devolution.php">Devolution</a></li>
                <?php    
                              }                    
                         } ?>
                <li class="search-box"><?php include 'search_book.php' ?></li>
            </ul>
        </nav>
        <div class="header-login">
            <?php if(!isset($_SESSION['userId'])){ ?>
            <a href="form_signIn_member.php" class="sing-in button">Sign in</a>
            <a href="form_signUp_member.php" class="sing-up button">Sign Up</a>
            <?php }else{?>
            <a href="shoppingCard.php" class="shoppingCard">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <?php } ?>
            <form action="Members/session_logOut_member.php" method="post" class="log-out">
                <button type="submit" class="btn">Log out</button>
            </form>
        </div>
    </header>
    <div class="barrier"></div>