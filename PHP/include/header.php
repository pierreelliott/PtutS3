<!-- NAVBAR -->		
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="index.php" id="active">Accueil</a></li>
        <li class="divider"></li>
        <li><a href="carte.php">Carte</a></li>
    </ul>
    <!--
    <div class="dropbtn">
        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
    </div>
    -->
    <ul class="nav navbar-nav navbar-right">
        <?php
            if(isset($_SESSION["pseudo"]))
            {
                ?>
                <li class="dropdown">
                    <a data-toggle="dropdown" href="#"><?php echo $_SESSION["pseudo"]; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Mon compte</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li class="divider"></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                    </ul>
                </li>
                <?php
            }
            else
            {
                echo '<li><a href="connexion.php">Connexion</a></li>';
            }
        ?>

        <li><a href="panier.php"><img src="images/panier.png" alt="Panier"></a></li>
    </ul>
</nav>
<!-- NAVBAR END -->

