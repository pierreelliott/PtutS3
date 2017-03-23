<?php
    $title = "Produits Favoris";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->
<!-- Popup d'information succès ajout produit -->
<div class="alert alert-success hidden">
  Produit correctement ajouté !
</div>
<!-- fin popup -->

<div class="row">
	<div class="col-lg-offset-2 col-lg-8 site-wrapper">
		<!-- Si l'utilisateur n'a pas de produits favoris -->
			<?php
				if($estVide == true) {
			?>

			<div class="row">
				<h1>Vous n'avez pas de produits dans vos favoris</h1>
			</div>
			<hr/>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<a class="btn btn-success btn-block" href="/carte"><h2>Regarder la carte !</h2></a>
				</div>
			</div>

			<?php
		} else { ?>

			<h1>Produits favoris</h1>

			<hr />

			<div class="panel-group text-dark">
				<div class="panel panel-default">
					<div id="collapse1" class="panel-collapse collapse in">
						<ul class="list-group">
							<?php $i = 0; foreach ($produitsFav as  $produit) { ?>

							<?php
							// Si le "produit" n'est pas un menu
							if($produit["estMenu"] == false) { ?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-sm-2">
										<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
									</div>
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-5">
												<p><?php echo $produit["libelle"]; ?></p>
											</div>
											<div class="col-sm-5">
												<p class="text-muted">Prix : <?php echo $produit["prix"]; ?> €</p>
											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-success btn-block btnAjout">
											<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
										</button>
									</div>
								</div>
							</li>
							<?php
							} else {
								// Si le "produit" n'est pas un menu
								// (Il faut changer le nom des variables)
							?>
							<li class="list-group-item">
								<div class="row">
									<div class="col-sm-5">
										<p><?php echo $produit["libelle"]; ?></p>
									</div>
									<div class="col-sm-5">
										<p class="text-muted">Prix : <?php echo $produit["prix"]; ?> €</p>
									</div>
									<div class="col-sm-2">
										<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-success btn-block btnAjout">
											<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
										</button>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-8">
										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" href="#collapseMenu<?php echo "".$i; //Vaudrait mieux mettre le numProduit ?>">Produits du menu</a>
													</h4>
												</div>
												<div id="collapse2" class="panel-collapse collapse">
													<ul class="list-group">
														<?php foreach ($variable as $key => $value) { ?>
														<li class="list-group-item">
															<div class="row">
																<div class="col-sm-2">
																	<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
																</div>
																<div class="col-sm-4">
																	<p><?php echo $produit["libelle"]; ?></p>
																</div>
															</div>
														</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php
								} $i++;
							} ?>
						</ul>
					</div>
				</div>
			</div>

			<?php
			}
			?>
	</div>
</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>

<script src="js/carte.js?v=<?php echo filemtime('css/carte.css'); ?>"></script>

<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
