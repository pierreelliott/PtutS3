<?php
    $title = "Administration";

	$admin = true; // L'affichage des produits se modifie en fonction de la carte ou de l'administration

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
			<div class="row">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#produits" data-toggle="tab">Produits</a></li>
					<li><a href="#menus" data-toggle="tab">Menus</a></li>
                    <li><a href="#avis" data-toggle="tab">Avis</a></li>
					<li><a href="#administrateurs" data-toggle="tab">Administrateurs</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="produits">
						<div class="row">
							<div class="col-sm-12">
								<!-- Bouton ajouter produit -->
								<span data-toggle="tooltip" data-placement="top" title="Ajouter un produit">
									<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminProduitAjout"></button>
								</span>
							</div>
						</div>

							<?php
								foreach($produits as $produit) {
									include("include/affichageProduit.php");
								}
							?>

					</div>
					<div class="tab-pane fade" id="menus">
						<div class="tab-pane fade in active" id="produits">
							<!-- Bouton ajouter menu -->
							<span data-toggle="tooltip" data-placement="top" title="Ajouter un menu">
								<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminMenuAjout"></button>
							</span>
							<?php
								foreach($menus as $menu) {
									include("include/affichageMenu.php");
								}
							?>
						</div>
					</div>

                    <!-- Onglet du tableau -->
                    <div class="tab-pane fade" id="avis">
                        <?php if($tousAvis != false)
                        {
                            include("vue/adminAvis.php");
                        }
                        else {
                            echo "<p class='jumbotron'>Aucun avis n'a été signalé</p>";
                        }
                         ?>
                    </div>
					<div class="tab-pane fade" id="administrateurs">
						<?php include("vue/administrateurs.php"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>




  	<!-- Début fenêtres modales -->
    <div class="modal fade" id="adminAvisConfirm">
	    <div class="modal-dialog">
	      	<?php include("vue/adminConfirm.php"); ?>
	    </div>
  	</div>

    <div class="modal fade" id="adminAvisModif">
	    <div class="modal-dialog">
	      	<?php include("vue/adminModifCommentaire.php"); ?>
	    </div>
  	</div>

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
	    <div class="modal-dialog modal-lg">
	      	<?php include("vue/adminSuppressionMenu.php"); ?>
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
