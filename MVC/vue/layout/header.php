<!-- NAVBAR -->	
<nav class="navbar navbar-static-top navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="index.php" id="active">Accueil</a></li>
        <li><a href="index.php?page=carte">Carte</a></li>
        <!--<li>
            <form class="navbar-form form-inline navbar-left">
                <div class="input-group"> 
                    <input type="search" class="form-control" placeholder="Rechercher">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form> 
        </li>-->
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <?php
            // Si l'utilisateur est connecté
            if(isset($_SESSION["utilisateur"]))
            {
                ?>
                <li class="dropdown">
                    <a data-toggle="dropdown" href="#"><?php echo $_SESSION["utilisateur"]["pseudo"]; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?page=utilisateur">Mon compte</a></li>
                        <li><a href="index.php?page=panier">Consulter panier</a></li>
                        <!--<li><a href="#">Recherche avancée</a></li>-->
                        <?php
                            if($_SESSION["utilisateur"]["typeUser"] == "ADMIN")
                            {
								echo '<li class="divider"></li>';
                                echo "<li><a href='index.php?page=administration&action=ajout'>Ajouter produit</a></li>\n";
                                echo "<li><a href='index.php?page=administration&action=modification'>Modifier produit</a></li>\n";
                                echo "<li><a href='index.php?page=administration&action=suppression'>Supprimer produit</a></li>\n";
                            }
                        ?>
                        <li class="divider"></li>
                        <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
                    </ul>
                </li>
                <?php
            }
            else
            {
                echo '<li><a href="index.php?page=connexion">Connexion</a></li>';
            }
        ?>

        <li><a href="index.php?page=panier"><span class="glyphicon glyphicon-shopping-cart"></a></li>
    </ul>
        
    
    <!--
    <div class="dropbtn">
        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
    </div>
    -->
</nav>
<!-- NAVBAR END -->