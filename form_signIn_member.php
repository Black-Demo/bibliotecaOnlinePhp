<?php include'header.php'?>

<form action="Members/db_signIn_member.php" method="post" class="login-form">
    <h1>Sign in</h1>
    <div class="txtb">
        <input type="text" name="mailuid">
        <span data-placeholder="E-mail..."></span>
    </div>

    <div class="txtb">
        <input type="password" name="pwd">
        <span data-placeholder="Password"></span>
    </div>
    <button type="submit" name="login-submit" class="logbtn">Login</button>
    <div class="bottom-text">
        Don't have account?
        <a href="form_singUp_member.php">Sing up</a>
    </div>
</form>



<?php include'footer.php'?>