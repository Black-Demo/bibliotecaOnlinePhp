<?php require 'header.php'; ?>

<div action="#" class="weather searchCity-box">
    <input type="text" class="cityWeather searchCity-txt" placeholder="Ciudad" />
    <button onClick="searchCity()" class="searchCity-btn">search</button>
</div>

<div class="res"></div>
<script src="script/apiWeather.js" asyn></script>
<?php require 'footer.php'; ?>