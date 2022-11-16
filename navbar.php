<header>
            <nav class="navbar">
                <a href="" class="logo">Binamax</a>
                <div class="nav-links">
                    <ul>
                        <li><a href="accueil.php">Accueil</a></li>
                        <li><a href="#">Mes Paris</a></li>
                        <li><a href="profil.php"> <?= $_SESSION["username"] ?> (Profil) </a></li>
                        <?php
                        if ($_SESSION["administrateur"] == 1) {
                            echo '<li><a href="staffmenu.php"> Staff Menu </a></li>';
                        }
                        ?>
                        <li><a href="sedeco.php"> Se deconnecter </a></li>
                    </ul>
                </div>
                <a href="profil.php" class="solde">Solde : <?= $_SESSION["argent"] ?> €</a>
            </nav>
</header>
