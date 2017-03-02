<?php
    $title = "Administration";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->
	<!-- Popup d'information succès ajout produit -->
	<div class="alert alert-success hidden">
		Produit correctement ajouté !
	</div>
	<!-- fin popup -->
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="row">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#produits" data-toggle="tab">Produits</a></li>
					<li><a href="#menus" data-toggle="tab">Menus</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="produits">
						<!-- Bouton ajouter produit -->
						<span data-toggle="tooltip" data-placement="top" title="Ajouter un produit">
							<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminProduitAjout"></button>
						</span>
							<?php
								foreach($produits as $produit) {
							?>
							<div class="produit">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<!-- Bouton modifier produit -->
										<span data-toggle="tooltip" data-placement="top" title="Modifier produit">
											<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin modifProduit" data-toggle="modal" data-target="#adminProduitModif" data-num-produit="<?php echo $produit["numProduit"]; ?>"></button>
										</span>
										<!-- Bouton supprimer produit -->
										<span data-toggle="tooltip" data-placement="top" title="Supprimer produit">
											<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin supprProduit" data-toggle="modal" data-target="#adminProduitSuppr" data-num-produit="<?php echo $produit["numProduit"]; ?>"></button>
										</span>
									</div>
									<div class="panel-body">
										<div class="media">
											<div class="media-left media-top">
												<img src="<?php echo $produit["sourceMoyen"]; ?>" class="media-object" style="width:80px">
											</div>
											<div class="media-body">
												<h2 class="media-heading text-muted"><?php echo $produit["libelle"]; ?></h2>
												<p class="text-muted pull-left"><?php echo $produit["description"]; ?></p>
												<p class="text-muted">Prix : <?php echo $produit["prix"]; ?>€</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						</ul>
					</div>
					<div class="tab-pane fade" id="menus">
						<div class="tab-pane fade in active" id="produits">
							<!-- Bouton ajouter menu -->
							<span data-toggle="tooltip" data-placement="top" title="Ajouter un menu">
								<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminMenuAjout"></button>
							</span>
							<?php
								foreach($menus as $menu) {
							?>
							<div class="menu">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<!-- Bouton modifier menu -->
										<span data-toggle="tooltip" data-placement="top" title="Modifier menu">
											<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin modifProduit" data-toggle="modal" data-target="#adminMenuModif" data-num-produit="<?php echo $menu["numProduit"]; ?>"></button>
										</span>
										<!-- Bouton supprimer menu -->
										<span data-toggle="tooltip" data-placement="top" title="Supprimer menu">
											<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin supprProduit" data-toggle="modal" data-target="#adminMenuSuppr" data-num-produit="<?php echo $menu["numProduit"]; ?>"></button>
										</span>
									</div>
									<div class="panel-body">
										<div class="media">
											<div class="media-left media-top">
												<img src="images/maki1,1.png" class="media-object" style="width:80px">
											</div>
											<div class="media-body menu-produit-container">
												<h2 class="media-heading text-muted">Menu "<?php echo $menu["libelle"]; ?>"</h2>
												<p class="text-muted pull-left"><?php echo $menu["description"]; ?></p>
												<p class="text-muted"><?php echo $menu["prix"]; ?> €</p>
												<?php
													foreach($menu["produits"] as $produit) {
												?>
												<div class="panel col-lg-6 menu-produit">
													<a href="#info" data-container="body" data-toggle="popover" data-trigger="focus" title="<p class='text-muted'><?php echo $produit["libelle"] ?></p>" data-content="<p class='text-muted'><?php echo $produit["description"] ?></p>" data-placement="auto right" data-html="true">
														<div class="panel-heading">
															<p><?php echo $produit["libelle"]; ?></p>
														</div>
														<div class="panel-body">
															<img src="<?php echo $produit["sourceMoyen"]; ?>" class="img-responsive" style="width:80px">
														</div>
													</a>
												</div>
												<?php
												}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

  	<!-- Début fenête modales -->
  	<div class="modal fade" id="adminProduitAjout">
	    <div class="modal-dialog">
	      	<?php include("vue/adminAjoutProduit.php"); ?>
	    </div>
  	</div>

  	<div class="modal fade" id="adminMenuAjout">
	    <div class="modal-dialog">
	      	<?php include("vue/adminAjoutMenu.php"); ?>
	    </div>
  	</div>

  	<div class="modal fade" id="adminProduitModif">
	    <div class="modal-dialog">
	      	<?php include("vue/adminModificationProduit.php"); ?>
	    </div>
  	</div>

  	<div class="modal fade" id="adminMenuModif">
	    <div class="modal-dialog">
	      	<?php include("vue/adminModificationMenu.php"); ?>
	    </div>
  	</div>

  	<div class="modal fade" id="adminProduitSuppr">
	    <div class="modal-dialog">
	      	<?php include("vue/adminSuppressionProduit.php"); ?>
	    </div>
  	</div>

	<div class="modal fade" id="adminMenuSuppr">
	    <div class="modal-dialog">
	      	<?php //include("vue/adminSuppressionMenu.php"); ?>
	    </div>
  	</div>
  	<!-- Fin fenêtres modales -->

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>

<script src="js/administration.js?v=<?php echo filemtime('css/style.css'); ?>"></script>

<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
