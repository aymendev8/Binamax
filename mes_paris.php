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
                <h2>Mes paris </h2>
            </div>
            <table class="tableau">
                <tr>
                    <th>Equipe 1</th>
                    <th>Equipe 2</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Cote E1</th>
                    <th>Cote nul</th>
                    <th>Cote E2</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $req = $bdd->prepare("SELECT * FROM les_matchs order by la_date, heure");
                $req->execute();
                while ($match = $req->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $match["equipe1"] . "</td>";
                    echo "<td>" . $match["equipe2"] . "</td>";
                    echo "<td>" . $match["la_date"] . "</td>";
                    echo "<td>" . $match["heure"] . "</td>";
                    echo "<td>" . $match["cote_equipe1"] . "</td>";
                    echo "<td>" . $match["cote_nul"] . "</td>";
                    echo "<td>" . $match["cote_equipe2"] . "</td>";
                    echo "<td><a href='modifier_match.php?id=" . $match["ID"] . "'>Modifier</a></td>";
                    echo "<td><a href='supprimer_match.php?id=" . $match["ID"] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>