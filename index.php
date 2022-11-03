<?php
require_once("header.php");
?>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Binamax</h2>
              <p class="text-white-50 mb-5">Entrer vos identifiant pour vous connectez !</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg" placeholder="adresse mail" />
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="mot de passe"  />
              </div>
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Se connecter</button>
            </div>

            <div>
              <p class="mb-0">Pas de compte? <a href="creercompte.php" class="text-white-50 fw-bold">créer un compte </a>
              </p>
            </div>
