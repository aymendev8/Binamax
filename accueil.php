<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}

?>
