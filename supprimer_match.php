<?php
require_once("header.php");
if(isset($_GET['id']) && $_SESSION["administrateur"] == 1 ){
    $req = $bdd->prepare("DELETE FROM les_matchs WHERE id = :id");
    $req->execute([
        "id" => $_GET['id']
    ]);
    header("Location:staffmenu.php");
    die;
}
?>