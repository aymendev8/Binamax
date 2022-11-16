<?php
require_once("header.php");
if(isset($_GET['id']) && $_SESSION["administrateur"] == 1 ){
    $req = $bdd->prepare("DELETE FROM utilisateurs WHERE id = :id");
    $req->execute([
        "id" => $_GET['id']
    ]);
    header("Location:staffmenu.php");
    die;
}else{
    header("Location:accueil.php");
    die;
}
?>