<?php
    $title = "Historique des commandes";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="row">
				<?php
					foreach($commandes as $commande) {
				?>
					<div class="media">
						<div class="media-left">
							<h1>Commande du <?php echo $commande['date']; ?></h1>
						</div>
						<div class="media-body">
							<p class="lead">Nombre de produits : <?php echo $commande["nbProduits"];?> €</p>
							<p class="lead">Prix de la commande : <?php echo $commande["prix"];?> €</p>
                            <p class="lead">Type de la commande : <?php echo $commande["typeCommande"];?> €</p>
                            <p class="lead">
                                <?php echo "<a href='index.php?page=commande&amp;numCommande={$commande['numCommande']}'> Afficher la commande</a>"?>
                            </p>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

    require("layout/site.php");
?>
