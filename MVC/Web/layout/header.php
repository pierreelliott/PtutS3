<!-- NAVBAR -->

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</button>
				<a class="navbar-brand" href="/" id="active">Accueil</a>
			</div>

			<div class="collapse navbar-collapse js-navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="/menu">Carte</a></li>
					<li><a href="/avis">Avis des utilisateurs</a></li>
					<li>
						<form method="post" action="/recherche" class="navbar-form form-inline navbar-left">
							<div class="input-group">
								<input type="search" name="nomProduitRecherche" class="form-control" placeholder="Rechercher">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</span>
							</div>
						</form>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php
					// Si l'utilisateur est connecté
					if($user->isAuthenticated()) {
					?>
					<li class="dropdown">
						<a data-toggle="dropdown" href="#"><?= $user->getAttribute('pseudo') ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/user">Mon compte</a></li>
							<li><a href="/panier">Consulter panier</a></li>
							<li><a href="/produits-favoris">Produits favoris</a></li>
							<li><a href="/historique-commandes">Historique Commandes</a></li>
							<?php
							//Si l'utilisateur est administrateur
							if($user->getAttribute('typeUser') == 'ADMIN')
							{
								echo '<li class="divider"></li>'.PHP_EOL.
								'<li><a href="/administration">Interface administrateur</a></li>'.PHP_EOL;
							}
							?>
							<li class="divider"></li>
							<li><a href="/disconnect">Déconnexion</a></li>
						</ul>
					</li>
					<?php
					}
					else
					{
						echo '<li><a href="/connect">Connexion</a></li>';
					}
					?>
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

<!-- NAVBAR END -->
