<form action="db_singUp_member.php" method='POST'>
<fieldset>
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
        <br>
        <input type="number" name="numPostal" id="numPostal" placeholder="postal number">
        
    </fieldset>
    <input type='submit' value='sing up' name='insert_member'>
</form>