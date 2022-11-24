<?php
require_once("header.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}

/* 
    classer les match pour voirs les plus proche en premier
*/
$req = $bdd->query("SELECT * FROM les_matchs order by la_date, heure");
$matchs = $req->fetchAll();



/* 
    payer les matchs qui sont passé
*/
$req = $bdd->prepare("SELECT lm.vainqueur, lp.gain, lp.est_payer, lp.equipe, lp.ID_match FROM les_matchs as lm  INNER JOIN les_paris as lp on lp.ID_match = lm.ID where lm.status_match = 2 AND lp.ID_utilisateur = ? ");
$req->execute([$_SESSION["id"]]);
$matchs_payer = $req->fetchAll();
if (isset($matchs_payer)) {
    foreach ($matchs_payer as $match_payer) {
        if ($match_payer["est_payer"] == 0) {
            if ($match_payer["vainqueur"] == $match_payer["equipe"]) {
                $req = $bdd->prepare("UPDATE les_paris as lp SET lp.est_payer = 1 WHERE ID_match = :id_match");
                $req->execute([
                    "id_match" => $match_payer["ID_match"]
                ]);
                $req_gain = $bdd->prepare("UPDATE utilisateurs SET argent = argent + :gain WHERE id = :id");
                $req_gain->execute([
                    "gain" => $match_payer["gain"],
                    "id" => $_SESSION["id"]
                ]);
                $req_argent = $bdd->prepare("SELECT argent FROM utilisateurs WHERE id = :id");
                $req_argent->execute([
                    "id" => $_SESSION["id"]
                ]);

                $argent = $req_argent->fetch();
                $_SESSION["argent"] = $argent["argent"];
            }
        }
    }
}

/* 
    placer le paris si l'utilisateur choisis l'equipe 1
*/
if (isset($_POST["equipe1"]) && $_SESSION["argent"] >= $_POST["mise"]) {
    $req = $bdd->prepare("INSERT INTO les_paris (ID_utilisateur, ID_match, equipe, mise, la_cote, gain) VALUES (:id_user, :id_match, :equipe, :mise, :cote, :gain)");
    $req->execute([
        "id_user" => $_SESSION["id"],
        "id_match" => $_POST["id_match"],
        "equipe" => $_POST["nom_equipe1"],
        "mise" => $_POST["mise"],
        "cote" => $_POST["equipe1"],
        "gain" => $_POST["mise"] * $_POST["equipe1"]
    ]);
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET argent = argent - :argent where id = :id');
    $userUpdate->execute([
        "argent" => $_POST['mise'],
        "id" => $_SESSION["id"]
    ]);
    $req = $bdd->prepare("SELECT argent FROM utilisateurs where id = :id");
    $req->execute([
        "id" => $_SESSION["id"]
    ]);
    /* 
        on update la variable de session argent pour qu'elle soit a jour
    */
    $argent = $req->fetch();
    $_SESSION["argent"] = $argent["argent"];
}

/* 
    placer le paris si l'utilisateur choisis l'equipe 2
*/
if (isset($_POST["equipe2"]) && $_SESSION["argent"] >= $_POST["mise"]) {
    $req = $bdd->prepare("INSERT INTO les_paris (ID_utilisateur, ID_match, equipe, mise, la_cote, gain) VALUES (:id_user, :id_match, :equipe, :mise, :cote, :gain)");
    $req->execute([
        "id_user" => $_SESSION["id"],
        "id_match" => $_POST["id_match"],
        "equipe" => $_POST["nom_equipe2"],
        "mise" => $_POST["mise"],
        "cote" => $_POST["equipe2"],
        "gain" => $_POST["mise"] * $_POST["equipe2"]
    ]);
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET argent = argent - :argent where id = :id');
    $userUpdate->execute([
        "argent" => $_POST['mise'],
        "id" => $_SESSION["id"]
    ]);
    $req = $bdd->prepare("SELECT argent FROM utilisateurs where id = :id");
    $req->execute([
        "id" => $_SESSION["id"]
    ]);

    $argent = $req->fetch();
    $_SESSION["argent"] = $argent["argent"];
}

/* 
    placer le paris si l'utilisateur choisis le match nul
*/
if (isset($_POST["match_nul"]) && $_SESSION["argent"] >= $_POST["mise"]) {
    $req = $bdd->prepare("INSERT INTO les_paris (ID_utilisateur, ID_match, equipe, mise, la_cote, gain) VALUES (:id_user, :id_match, :equipe, :mise, :cote, :gain)");
    $req->execute([
        "id_user" => $_SESSION["id"],
        "id_match" => $_POST["id_match"],
        "equipe" => "egalite",
        "mise" => $_POST["mise"],
        "cote" => $_POST["match_nul"],
        "gain" => $_POST["mise"] * $_POST["match_nul"]
    ]);
    $userUpdate = $bdd->prepare('UPDATE utilisateurs SET argent = argent - :argent where id = :id');
    $userUpdate->execute([
        "argent" => $_POST['mise'],
        "id" => $_SESSION["id"]
    ]);
    $req = $bdd->prepare("SELECT argent FROM utilisateurs where id = :id");
    $req->execute([
        "id" => $_SESSION["id"]
    ]);

    $argent = $req->fetch();
    $_SESSION["argent"] = $argent["argent"];
}

require_once("navbar.php");
?>
<link rel="stylesheet" href="Styles/accueil.css">
<h2 class="titre_paris">Les paris disponible</h2>
<?php
foreach ($matchs as $match) {
    if ($match["status_match"] != 2) {

        $date = strtotime($match["la_date"]);
        $date = date("d/m", $date);
        $heure = strtotime($match["heure"]);
        $heure = date("H:i", $heure);
?>
        <section class="paris_dispo">
            <div class="container">
                <ul class="paris_equipe">
                    <li><a href="#" id="<?= $match["equipe1"] ?>"><?= $match["equipe1"] ?></a></li>
                    <li>VS</li>
                    <li><a href="#"><?= $match["equipe2"] ?></a></li>
                </ul>
                <ul class="date_heure">
                    <li><?= $date ?></li>
                    <li><?= $heure ?></li>
                </ul>
                <form action="" method="POST">
                    <input type="int" name="mise" placeholder="Votre mise : " required>
                    <input type="hidden" name="id_match" value="<?= $match["ID"] ?>">
                    <input type="hidden" name="nom_equipe1" value="<?= $match["equipe1"] ?>">
                    <input type="hidden" name="nom_equipe2" value="<?= $match["equipe2"] ?>">

                    <ul class="paris_cote">
                        <li><button type="submit" value="<?= $match["cote_equipe1"] ?>" name="equipe1"> <?= $match["cote_equipe1"] ?> </button></li>
                        <li><button type="submit" value="<?= $match["cote_nul"] ?>" name="match_nul"> <?= $match["cote_nul"] ?> </button></li>
                        <li><button type="submit" value="<?= $match["cote_equipe2"] ?>" name="equipe2"> <?= $match["cote_equipe2"] ?> </button></li>
                    </ul>
                </form>
            </div>
        </section>
<?php
    }
}
?>