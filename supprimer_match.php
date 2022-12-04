<?php
require_once("header.php");
if(isset($_GET['id']) && $_SESSION["administrateur"] == 1 ){
    $del_lesparis = $bdd->prepare("DELETE FROM les_paris WHERE ID_match = :id");
    $del_lesparis->execute([
        "id" => $_GET['id']
    ]);
    $req = $bdd->prepare("DELETE FROM les_matchs WHERE ID = :id");
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