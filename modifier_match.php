<?php
require_once("header.php");
require_once("navbar.php");
if (!isset($_SESSION["id"])) {
    header("Location:sedeco.php");
} elseif ($_SESSION["administrateur"] == 0) {
    header("Location:accueil.php");
}
if (isset($_POST['equipe1']) && isset($_POST['equipe2'])) {
    $userUpdate = $bdd->prepare('UPDATE les_matchs SET equipe1 = :equipe1, equipe2 = :equipe2, score1 = :score1, score2 = :score2 ,la_date = :la_date, heure = :heure, cote_equipe1 = :cote_equipe1, cote_equipe2 = :cote_equipe2, cote_nul = :cote_nul, vainqueur = :vainqueur, status_match = :status_match where id = :id');
    $userUpdate->execute([
        "equipe1" => $_POST['equipe1'],
        "equipe2" => $_POST['equipe2'],
        "score1" => $_POST['score1'],
        "score2" => $_POST['score2'],
        "la_date" => $_POST['la_date'],
        "heure" => $_POST['heure'],
        "cote_equipe1" => $_POST['cote_equipe1'],
        "cote_equipe2" => $_POST['cote_equipe2'],
        "cote_nul" => $_POST['cote_nul'],
        "vainqueur" => $_POST['vainqueur'],
        "status_match" => $_POST['status_match'],
        "id" => $_GET['id']
    ]);
}
?>
<link rel="stylesheet" href="Styles/edit.css">
<br>
<section id="edit">
    <div class="container">
        <div class="title">
            <h2>Modifier le match</h2>
        </div>
        <?php
        $req = $bdd->prepare("SELECT * FROM les_matchs where id = ?");
        $req->execute([$_GET['id']]);
        $match = $req->fetch();
        ?>
        <form action="#" method="POST">
            <input value="<?= $match['equipe1'] ?>" type="text" name="equipe1" placeholder="Nom de l'equipe 1" required>
            <input value="<?= $match['equipe2'] ?>" type="text" name="equipe2" placeholder="Nom de l'equipe 2" required>
            <input value="<?= $match['score1'] ?>" type="text" name="score1" placeholder="Score de l'equipe 1" required>
            <input value="<?= $match['score2'] ?>" type="text" name="score2" placeholder="Score de l'equipe 2" required>
            <input value="<?= $match['cote_equipe1'] ?>" type="int" name="cote_equipe1" placeholder="la cote de equipe 1" required>
            <input value="<?= $match['cote_equipe2'] ?>" type="int" name="cote_equipe2" placeholder="la cote de equipe 2" required>
            <input value="<?= $match['cote_nul'] ?>" type="int" name="cote_nul" placeholder="la cote match nul" required>
            <select type="int" name="status_match" id="vainqueur" required>
                <option value="">Le status du match </option>
                <option value="0">match pas encore commencer</option>
                <option value="1">match en cours</option>
                <option value="2">match terminer</option>
            </select>
            <input value="<?= $match['la_date'] ?>" type="date" name="la_date" placeholder="La date du match" required>
            <input value="<?= $match['heure'] ?>" type="time" name="heure" placeholder="L'heure du match" required>
            <?php // Mettre le vainqueur du match à lorsque le match se fini , sinon ne pas toucher ?>
            <select name="vainqueur" id="vainqueur">
                <option value="">Le vainqueur du match</option>
                <option value="<?= $match['equipe1'] ?>"><?= $match['equipe1'] ?></option>
                <option value="Match nul"><?= "Match nul" ?></option>
                <option value="<?= $match['equipe2'] ?>"><?= $match['equipe2'] ?></option>
            </select>
            <button type="submit" name="submit">Modifier</button>
        </form>
</section>
</div>