<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
}elseif ($_SESSION["administrateur"] == 0) {
    header("Location:accueil.php");
}

if (isset($_POST["equipe1"])) {
      $insertmatch = $bdd->prepare("INSERT INTO les_matchs(equipe1,equipe2,la_date,heure,cote_equipe1,cote_equipe2,cote_nul)
                                      VALUES(:equipe1,:equipe2,:la_date,:heure,:cote_equipe1,:cote_equipe2,:cote_nul)");
      $insertmatch->execute([
        "equipe1" => $_POST["equipe1"],
        "equipe2" => $_POST["equipe2"],
        "la_date" => $_POST["la_date"],
        "heure" => $_POST["heure"],
        "cote_equipe1" => $_POST["cote_equipe1"],
        "cote_equipe2" => $_POST["cote_equipe2"],
        "cote_nul" => $_POST["cote_nul"]
      ]);
    }
?>

<div class="staff">
<link rel="stylesheet" href="Styles/edit.css">
<link rel="stylesheet" href="Styles/staffmenu.css">
<br>
            <section id ="edit">
            <div class="container">
                <div class="title">
                    <h2>Creer un match</h2>
                </div>
                <form action="#" method="POST">
                    <input type="text" name="equipe1" placeholder="Nom de l'equipe 1" required>
                    <input type="text" name="equipe2" placeholder="Nom de l'equipe 2" required>
                    <input type="date" name="la_date"  placeholder="La date du match" required>
                    <input type="time" name="heure"  placeholder="L'heure du match" required>
                    <input type="int" name="cote_equipe1"  placeholder="la cote de equipe 1" required>
                    <input type="int" name="cote_equipe2"  placeholder="la cote de equipe 2" required>
                    <input type="int" name="cote_nul"  placeholder="la cote match nul " required>
                    <button type="submit" name="submit">Creer</button>
                </form>
            </section>
        <section id="list_match">
            <div class="container">
                <div class="title">
                    <h2>Liste des matchs</h2>
                </div>
                <table class ="tableau">
                    <tr>
                        <th>Equipe 1</th>
                        <th>Equipe 2</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Cote E1</th>
                        <th>Cote nul</th>
                        <th>Cote E2</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                    $req = $bdd->prepare("SELECT * FROM les_matchs");
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
                        echo "<td><a href='supprimer_match.php?id=" . $match["ID"] . "'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
</div>
