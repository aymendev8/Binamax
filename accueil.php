<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:accueil.php");
}
?>
<p> <?= $_SESSION["username"] ?></p>