<!-- NAVBAR -->		
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="index.php" id="active">Accueil</a></li>
        <li><a href="carte.php">Carte</a></li>
        <li>
            <form class="navbar-form form-inline navbar-left"">
                <div class="input-group"> 
                    <input type="search" class="form-control" placeholder="Rechercher">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form> 
        </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <?php
            if(isset($_SESSION["pseudo"])) // L'utilsateur est connecté
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

        <li><a href="panier.php"><span class="glyphicon glyphicon-shopping-cart"></a></li>
    </ul>
        
    
    <!--
    <div class="dropbtn">
        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
    </div>
    -->
</nav>
<!-- NAVBAR END -->

