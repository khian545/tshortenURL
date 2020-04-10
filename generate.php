<?php
include "header.php";

include 'URLShortener.php';
$shortener = new URLShortener();
$shortener->data["destination"] = $_GET["destination"];
echo '...Generating...';
echo '<br/>';
$shortener->generateShortURL();
echo '<br/>'; echo '<br/>';

include "footer.php";
 ?>
