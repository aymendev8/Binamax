<?php
require_once("header.php");
if(isset($_POST['prenom']) && strlen($_POST["prenom"]) > 4 && isset($_POST['nom']) && strlen($_POST["nom"]) > 4 && isset($_POST['mdp']) && strlen($_POST["mdp"]) > 5 && isset($_POST['username']) && strlen($_POST["username"]) > 4) {
    $insertuser = $bdd->prepare("INSERT INTO utilisateurs(prenom,nom,mail,mot_de_passe,username)
                                VALUES(:prenom,:nom,:mail,:mot_de_passe,:username)");
    $insertuser->execute([
        "prenom" => $_POST["prenom"],
        "nom" => $_POST["nom"],
        "mail" => $_POST["email"],
        "mot_de_passe" => md5($_POST["mdp"]),
        "username" => $_POST["username"]
    ]);

    header('Location:index.php');
    die;
}

?>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Binamax</h2>
              <p class="text-white-50 mb-5">Entrer vos information pour créer un compte !</p>
                <form action="" method="POST">
                    <div class="form-outline form-white mb-4">
                        <input type="texte" name="prenom" class="form-control form-control-lg" placeholder="Prenom" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input type="texte" name="username" class="form-control form-control-lg" placeholder="Nom d'utilisateur" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input type="texte" name="nom" class="form-control form-control-lg" placeholder="Nom" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="adresse mail" />
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input type="password" name="mdp" class="form-control form-control-lg" placeholder="mot de passe"  />
                    </div>
                    <button class="btn btn-outline-light btn-lg px-5" type="submit" href="index.php">Creer le compte</button>
                </form>
            </div>
            <div>
              <p class="mb-0">Revenir en arriere ? <a href="index.php" class="text-white-50 fw-bold">se connecter</a>
              </p>
            </div>