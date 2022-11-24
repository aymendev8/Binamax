<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}
?>
 <link rel="stylesheet" href="Styles/tableau.css">
    <section class="liste">
        <div class="container">
            <div class="title">
                <h2>Mes paris en cours </h2>
            </div>
            <table class="tableau">
                <tr>
                    <th>Equipe 1</th>
                    <th>G</th>
                    <th>VS</th>
                    <th>G</th>
                    <th>Equipe 2</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Status</th>
                    <th>Mise</th>
                    <th>Gain Potentiel</th>
                </tr>
                <?php
                $req = $bdd->prepare("SELECT  lp.ID_match, lp.gain, lp.mise, lm.equipe1, lm.score1, lm.equipe2, lm.score2, lm.la_date, lm.heure, lm.status_match  FROM les_paris as lp INNER JOIN les_matchs as lm on lp.ID_match = lm.ID where ID_utilisateur = :id");
                $req->execute([
                    "id" => $_SESSION["id"]
                ]);
                while ($match = $req->fetch()) {
                    if($match["status_match"] == 0){
                        $status = "A venir";
                    }else if($match["status_match"] == 1){
                        $status = "En cours";
                    }
                    if($match["status_match"] != 2){
                        $date = strtotime($match["la_date"]);
                        $date = date("d/m", $date);
                        $heure = strtotime($match["heure"]);
                        $heure = date("H:i", $heure);
                            
                        echo "<tr>";
                        echo "<td>" . $match["equipe1"] . "</td>";
                        echo "<td>" . $match["score1"] . "</td>";
                        echo "<td>VS</td>";
                        echo "<td>" . $match["score2"] . "</td>";
                        echo "<td>" . $match["equipe2"] . "</td>";
                        echo "<td>" . $date . "</td>";
                        echo "<td>" . $heure . "</td>";
                        echo "<td>" .$status . "</td>";
                        echo "<td>" . $match["mise"] .  " €" . "</td>";
                        echo "<td>" . $match["gain"] .  " €" . "</td>";
                        echo "</tr>";
                    }
                }  
                ?>
            </table>
        </div>
    </section>
    <section class="liste">
        <div class="container">
            <div class="title">
                <h2> Historique des paris  </h2>
            </div>
            <table class="tableau">
                <tr>
                    <th>Equipe 1</th>
                    <th>G</th>
                    <th>VS</th>
                    <th>G</th>
                    <th>Equipe 2</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Status</th>
                    <th>Mise</th>
                    <th>Gain potentiel</th>
                    <th>Etat</th>
                </tr>
                <?php
                $req = $bdd->prepare("SELECT  lp.ID_match, lp.gain, lp.mise, lp.equipe, lm.equipe1, lm.score1, lm.equipe2, lm.score2, lm.la_date, lm.heure, lm.status_match, lm.vainqueur  FROM les_paris as lp INNER JOIN les_matchs as lm on lp.ID_match = lm.ID where ID_utilisateur = :id");
                $req->execute([
                    "id" => $_SESSION["id"]
                ]);
                while ($match = $req->fetch()) {
                    if($match["status_match"] == 2){
                        $date = strtotime($match["la_date"]);
                        $date = date("d/m", $date);
                        $heure = strtotime($match["heure"]);
                        $heure = date("H:i", $heure);
                        $status = "Terminé";
                        if($match["vainqueur"] == $match["equipe"]){
                            $etat = "Gagné";
                        }else{
                            $etat = "Perdu";
                        }
                            
                        echo "<tr>";
                        echo "<td>" . $match["equipe1"] . "</td>";
                        echo "<td>" . $match["score1"] . "</td>";
                        echo "<td>VS</td>";
                        echo "<td>" . $match["score2"] . "</td>";
                        echo "<td>" . $match["equipe2"] . "</td>";
                        echo "<td>" . $date . "</td>";
                        echo "<td>" . $heure . "</td>";
                        echo "<td>" .$status . "</td>";
                        echo "<td>" . $match["mise"] .  " €" . "</td>";
                        echo "<td>" . $match["gain"] .  " €" . "</td>";
                        echo "<td>" . $etat . "</td>";
                        echo "</tr>";
                    }
                }  
                ?>
            </table>
        </div>
    </section>