<?php
require_once("header.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}
if (isset($_POST['username']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['mail'])) {
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET username = :username, prenom = :prenom, nom = :nom, mail = :mail where id = :id');
    $userUpdate->execute([
        "username" => $_POST['username'],
        "prenom" => $_POST['prenom'],
        "nom" => $_POST['nom'],
        "mail" => $_POST['mail'],
        "id" => $_SESSION['id']
    ]);
    $checkuser = $bdd->prepare("SELECT id, mot_de_passe,administrateur,nom,prenom,username,mail FROM utilisateurs WHERE username=?");
    $checkuser->execute([$_POST['username']]);
    $user = $checkuser->fetch();
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["mail"] = $user["mail"];
        $_SESSION["prenom"] = $user["prenom"];
}

if (isset($_POST["argent"])){
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET argent = argent + :argent where id = :id');
    $userUpdate->execute([
        "argent" => $_POST['argent'],
        "id" => $_SESSION['id']
    ]);
    $checkuser = $bdd->prepare("SELECT argent FROM utilisateurs WHERE username=?");
    $checkuser->execute([$_SESSION['username']]);
    $user = $checkuser->fetch();
        $_SESSION["argent"] = $user["argent"];
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
                <form action="#" method="POST">
                    <input value="<?= $_SESSION["username"] ?>" type="text" name="username" placeholder="Votre nom d'utilisateur" required>
                    <input value="<?= $_SESSION["nom"] ?>" type="text" name="nom" placeholder="Votre nom" required>
                    <input value="<?= $_SESSION["prenom"] ?>" type="text" name="prenom" placeholder="Votre prenom" required>
                    <input value="<?= $_SESSION["mail"] ?>" type="mail" name="mail" placeholder="Votre adresse mail" required>
                    <input type="number" name="argent"  placeholder="Combien d'argent ajouter ?">
                    <button type="submit" name="submit">Modifier</button>
                </form>
            </section>
        </div>