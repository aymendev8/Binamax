<?php
require_once("header.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}elseif($_SESSION["administrateur"] == 0) {
    header("Location:accueil.php");
}
if (isset($_POST['username']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['mail'])) {
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET username = :username, prenom = :prenom, nom = :nom, mail = :mail where id = :id');
    $userUpdate->execute([
        "username" => $_POST['username'],
        "prenom" => $_POST['prenom'],
        "nom" => $_POST['nom'],
        "mail" => $_POST['mail'],
        "id" => $_GET['id']
    ]);

}

if (isset($_POST["argent"])){
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET argent = argent + :argent where id = :id');
    $userUpdate->execute([
        "argent" => $_POST['argent'],
        "id" => $_GET['id']
    ]);

}
require_once("navbar.php");
?>
<link rel="stylesheet" href="Styles/edit.css">
<br>
            <section id="edit">
            <div class="container">
                <div class="title">
                    <h2>Modifier le profil</h2>
                </div>
                <?php
                    $req = $bdd->prepare("SELECT * FROM utilisateurs where id = ?");
                    $req->execute([$_GET['id']]);
                    $user = $req->fetch();
                ?>
                <form action="#" method="POST">
                    <input value="<?= $user["username"] ?>" type="text" name="username" placeholder="Votre username" required>
                    <input value="<?= $user["nom"] ?>" type="text" name="nom" placeholder="Votre nom" required>
                    <input value="<?= $user["prenom"] ?>" type="text" name="prenom" placeholder="Votre prenom" required>
                    <input value="<?= $user["mail"] ?>" type="mail" name="mail" placeholder="votre adresse mail" required>
                    <input type="number" name="argent"  placeholder="Combien d'argent ajouter ?">
                    <button type="submit" name="submit">Modifier</button>
                </form>
            </section>
        </div>