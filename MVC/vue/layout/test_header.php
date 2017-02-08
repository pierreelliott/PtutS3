<!-- NAVBAR -->

		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
				</button>
				<a class="navbar-brand" href="/accueil" id="active">Accueil</a>
			</div>

			<div class="collapse navbar-collapse js-navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="/carte">Carte</a></li>
					<li><a href="/avis">Avis des utilisateurs</a></li>
					<li>
						<form class="navbar-form form-inline navbar-left">
						<!--<div class="input-group">
							<input type="search" class="form-control" placeholder="Rechercher">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div> -->
						</form>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php
					// Si l'utilisateur est connecté
					if(isset($_SESSION["utilisateur"]))
					{?>
					<li class="dropdown">
						<a data-toggle="dropdown" href="#"><?php echo $_SESSION["utilisateur"]["pseudo"]; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/utilisateur">Mon compte</a></li>
							<li><a href="/panier">Consulter panier</a></li>
							<li><a href="/historique-commandes">Historique Commandes</a></li>
							<?php
							//Si l'utilisateur est administrateur
							if($_SESSION["utilisateur"]["typeUser"] == "ADMIN")
							{
								echo '<li class="divider"></li>';
								echo "<li><a href='/administration'>Interface administrateur</a></li>\n";
							}
							?>
							<li class="divider"></li>
							<li><a href="/deconnexion">Déconnexion</a></li>
						</ul>
					</li>
					<?php
					}
					else
					{
						echo '<li><a href="/connexion">Connexion</a></li>';
					}						?>

					<li>
						<a href="/panier">
						<span class="glyphicon glyphicon-shopping-cart"></span>
						<span id="qtePanier" class="badge">
							<?php if(isset($_SESSION["nbProduit"]))
						{
							echo $_SESSION["nbProduit"];
						}
						else
						{
							echo "0";
						}
                        ?>
						</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>

    <!--
    <div class="dropbtn">
        <p><img src="images/burger_menu.png" alt="dropbtn"/></p>
    </div>
    -->

<!-- NAVBAR END -->
