<!-- NAVBAR -->		
<nav class="row">				
    <div class="col-lg-offset-3 col-lg-2">
        <a href="index.php" id="active">Accueil</a>
    </div>
    <!--
    <div class="dropbtn">
        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
    </div>
    -->

    <div class="col-lg-2">				
        <a href="carte.php">Carte</a>
    </div>
    <div class="col-lg-2">
        <?php
            if(isset($_SESSION["pseudo"]))
            {
                echo '<a href="deconnexion.php">Déconnexion</a>';
            }
            else
            {
                echo '<a href="connexion.php">Connexion</a>';
            }
        ?>
    </div>
</nav>
<!-- NAVBAR END -->

