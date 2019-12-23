<?php include'header.php'?>
<h1>Sing in</h1>
<img src="src/logo.png" alt="logo">
<form action="Members/db_singIn_member.php" method="post" class="form_singIn">
    <input type="text" name="mailuid" placeholder="E-mail...">
    <input type="password" name="pwd" placeholder="Password...">
    <button type="submit" name="login-submit">Login</button>
    <a href="form_singUp_member.php">I don't have an acount</a>
</form>
<?php include'footer.php'?>