<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}

$req = $bdd->query("SELECT * FROM les_matchs order by la_date, heure");
$matchs = $req->fetchAll();
?>
<link rel="stylesheet" href="Styles/accueil.css">
<h2 class="titre_paris">Les paris disponible</h2>
<?php
foreach ($matchs as $match) {
    $date = strtotime($match["la_date"]);
    $date = date("d/m", $date);
    $heure = strtotime($match["heure"]);
    $heure = date("H:i", $heure);
?>
    <section class="paris_dispo">
        <div class="container">
            <ul class="paris_equipe">
                <li><a href=""><?= $match["equipe1"] ?></a></li>
                <li>VS</li>
                <li><a href=""><?= $match["equipe2"] ?></a></li>
            </ul>
            <ul class="date_heure">
                <li><?= $date ?></li>
                <li><?= $heure ?></li>
            </ul>
            <ul class="paris_cote">
                <li><button> <?= $match["cote_equipe1"] ?> </button></li>
                <li><button> <?= $match["cote_nul"] ?> </button></li>
                <li><button> <?= $match["cote_equipe2"] ?> </button></li>
            </ul>
        </div>
    </section>
<?php
}
?>