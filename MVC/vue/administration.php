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
					<li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
					<li><a href="#menus" data-toggle="tab">Nos menus</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="produits">
						<!-- Bouton ajouter produit -->
						<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminAjout"></button>
							<?php
								foreach($produits as $key => $produit) {
							?>
							<div class="produit">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin modifProduit" data-toggle="modal" data-target="#adminModif" data-num-produit="<?php echo $produit["numProduit"]; ?>"></button>
										<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin supprProduit" data-toggle="modal" data-target="#adminSuppr" data-num-produit="<?php echo $produit["numProduit"]; ?>"></button>
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
						<div class="col-xs-6">
							<hr/>
							<?php
							foreach($menus as $menu)
							{
							?>
								<div class="panel panel-default">
									<div class="media">
										<div class="media-left media-top">
											<img src="images/maki1,1.png" class="media-object" style="width:80px">
										</div>
										<div class="media-body menu-produit-container">
											<h2 class="media-heading text-muted">Menu "<?php echo $menu["libelle"]; ?>"</h2>
											<p class="text-muted pull-left"><?php echo $menu["description"]; ?></p>
											<p class="text-muted"><?php echo $menu["prix"]; ?></p>
											<?php
											foreach($menu["produits"] as $produit)
											{
											?>
												<div class="panel col-lg-6 menu-produit">
													<div class="media">
														<div class="media-left media-top">
															<img src="<?php echo $produit["sourceMoyen"]; ?>" class="media-object img-responsive" style="width:80px">
														</div>
														<div class="media-body">
															<h2 class="media-heading text-muted"><?php echo $produit["libelle"]; ?></h2>
															<p class="text-muted pull-left"><?php echo $produit["description"]; ?></p>
														</div>
													</div>
												</div>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
						<div class="col-xs-6">
							<button type="button" class="btn btn-success btn-lg btn-block btn-admin" data-toggle="modal" data-target="#adminAjout">Ajouter un menu</button>
							<button type="button" class="btn btn-primary btn-lg btn-block btn-admin modifProduit" data-toggle="modal" data-target="#adminModif">Modifier un menu</button>
							<button type="button" class="btn btn-danger btn-lg btn-block btn-admin supprProduit" data-toggle="modal" data-target="#adminSuppr">Supprimer un menu</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

  <!-- Début fenête modales -->
  <div class="modal fade" id="adminAjout">
    <div class="modal-dialog">
      <?php include("vue/adminAjoutProduit.php"); ?>
    </div>
  </div>

  <div class="modal fade" id="adminModif">
    <div class="modal-dialog">
      <?php include("vue/adminModificationProduit.php"); ?>
    </div>
  </div>

  <div class="modal fade" id="adminSuppr">
    <div class="modal-dialog">
      <?php include("vue/adminSuppressionProduit.php"); ?>
    </div>
  </div>
  <!-- Fin fenêtres modales -->

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>

<script language="javascript" src="js/administration.js?v=<?php echo filemtime('css/style.css'); ?>"></script>

<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
