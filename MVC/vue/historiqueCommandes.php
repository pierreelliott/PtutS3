<?php
    $title = "Historique des commandes";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<?php
			if($estVide == true)
			{?>
				<div class="row">
					<h1>Vous n'avez pas encore commandé</h1>
				</div>
				<hr/>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<a class="btn btn-success btn-block" href="/carte"><h2>Commander !</h2></a>
					</div>
				</div>
			<?php
			}
			else
			{
			?>
			<div class="row">
				<?php
					foreach($commandes as $commande) {
				?>
					<div class="panel panel-default">
						<div class="panel-heading texte-commande">
							<h1>Commande du <?php echo $commande['date']; ?></h1>
						</div>
						<div class="panel-body text-dark">
							<p class="lead">Nombre de produits : <?php echo $commande["nbProduits"];?></p>
							<p class="lead">Prix de la commande : <?php echo $commande["prix"];?> €</p>
                            <p class="lead">Type de la commande : <?php echo $commande["typeCommande"];?></p>
                            <p class="lead">
                                <?php echo "<a class='text-primary' href='/commande-{$commande['numCommande']}'> Afficher la commande</a>"?>
                            </p>
						</div>
					</div>

			<?php } ?>
            </div>
		<?php } ?>

		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

    require("layout/site.php");
?>
