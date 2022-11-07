<?php
require_once("header.php");
//require_once("navbar.php");
?>
<h2 id = "modifier_profil">Modifier le profil </h2>
<br>
<form action="" method="POST">
    <div class="row">
        <div class="col-md-2">
            <label for="">Username</label>
        </div>
        <div class="col-md-9">
            <input value="<?= $_SESSION["username"] ?>" class="form-control" type="text" name="username">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="">nom</label>
        </div>
        <div class="col-md-9">
            <input value="<?= $_SESSION["nom"] ?>" class="form-control" type="text" name="nom">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="">prenom</label>
        </div>
        <div class="col-md-9">
            <input value="<?= $_SESSION["prenom"]?>" class="form-control" type="text" name="prenom">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="">Adresse Mail</label>
        </div>
        <div class="col-md-9">
            <input value="<?= $_SESSION["mail"] ?>" class="form-control" type="email" name="mail">
        </div>
    </div>
    <br>
    <input type="submit" class="btn btn-primary">
</form>