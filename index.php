<?php
require_once("header.php");

if (isset($_POST['username']) && isset($_POST['mdp'])) {
  $checkuser = $bdd->prepare("SELECT id, mot_de_passe,administrateur,nom,prenom,username,mail,argent FROM utilisateurs WHERE username=?");
  $checkuser->execute([$_POST['username']]);
  $user = $checkuser->fetch();
  if ($user) {
    if (md5($_POST['mdp']) == $user['mot_de_passe']) {
      $_SESSION["id"] = $user["id"];
      $_SESSION["administrateur"] = $user["administrateur"];
      $_SESSION["nom"] = $user["nom"];
      $_SESSION["username"] = $user["username"];
      $_SESSION["mail"] = $user["mail"];
      $_SESSION["prenom"] = $user["prenom"];
      $_SESSION["mdp"] = $user["mot_de_passe"];
      $_SESSION["argent"] = $user["argent"];
    }
    header('Location:accueil.php');
    die;
  }
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
              <p class="text-white-50 mb-5">Entrez vos identifiants pour vous connectez !</p>
              <form action="" method="POST">
                <div class="form-outline form-white mb-4">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Nom d'utilisateur" />
                </div>

                <div class="form-outline form-white mb-4">
                  <input type="password" name="mdp" class="form-control form-control-lg" placeholder="Mot de passe" />
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Se connecter</button>
              </form>
            </div>

            <div>
              <p class="mb-0">Pas de compte? <a href="creercompte.php" class="text-white-50 fw-bold">Créer un compte </a>
              </p>
            </div>