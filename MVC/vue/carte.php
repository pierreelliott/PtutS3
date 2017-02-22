<?php
    $title = "La carte";

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
      <ul class="nav nav-tabs">
        <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
        <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
      </ul>
      <div class="tab-content">
		<!-- Affichage des produits seuls -->
        <div class="tab-pane fade in active" id="produits">
			<?php
				foreach($carte as $produit) {
			?>
			<div id="<?php echo $produit["numProduit"]; ?>" class="panel panel-default">

				<div class="media img-produit">
					<a href="#produitModal" data-toggle="modal"
	                            data-libelle="<?php echo $produit["libelle"]; ?>"
	                            data-source-img="<?php echo $produit['sourceMoyen'].".png"; ?>"
	                            data-description="<?php echo $produit["description"]; ?>"
	                            data-prix="<?php echo $produit["prix"]; ?>">
						<div class="media-left media-top">
							<img src="<?php echo $produit["sourceMoyen"]; ?>.png" alt="Image <?php echo $produit["libelle"]; ?>" class="media-object img-thumbnail" style="width:80px">
						</div>
						<div class="media-body">
							<h2 class="media-heading text-muted"><?php echo $produit["libelle"]; ?></h2>
							<p class="text-muted pull-left"><?php echo $produit["description"]; ?></p>
						</div>
					</a>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-3">
							<p>Prix : <?php echo $produit["prix"]; ?> €</p>
						</div>
						<div class="col-xs-offset-6 col-xs-3">
							<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-primary btn-block btnAjout">
								<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
							</button>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>
          <div class="modal fade" id="produitModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  <h4 class="modal-title">Produit</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-4">
                      <img src="images/sushi.png" alt="Image du produit" id="imgModal" class="img-responsive">
                    </div>
                    <div class="col-xs-8">
                      <p id="descriptionProduit"></p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <p id="prixProduit" class="text-center"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
		<!-- Affichage des menus -->
        <div class="tab-pane fade" id="menus">
			<hr/>
          <?php
		  foreach($menus as $menu)
			{
			?>
				<div class="panel panel-default">
					<div class="media">
						<div class="media-left media-top">
							<img src="images/maki1,1.png" alt="Image <?php echo $menu["libelle"]; ?>" class="media-object" style="width:80px">
						</div>
						<div class="media-body menu-produit-container">
							<h2 class="media-heading text-muted">Menu "<?php echo $menu["libelle"]; ?>"</h2>
							<p class="text-muted pull-left"><?php echo $menu["description"]; ?></p>
							<p class="text-muted"><?php echo $menu["prix"]; ?> €</p>
							<?php
							foreach($menu["produits"] as $produit)
							{
							?>
								<div class="panel col-lg-6 menu-produit">
                                    <a href="#info" data-container="body" data-toggle="popover" data-trigger="focus" title="<p class='text-muted'><?php echo $produit["libelle"] ?></p>" data-content="<p class='text-muted'><?php echo $produit["description"] ?></p>" data-placement="auto right" data-html="true">
										<div class="panel-heading">
											<p><?php echo $produit["libelle"]; ?></p>
										</div>
										<div class="panel-body">
											<img src="<?php echo $produit["sourceMoyen"]; ?>.png" alt="Image <?php echo $produit["libelle"] ?>" class="img-responsive" style="width:80px">
										</div>
                                    </a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-lg-offset-9 col-lg-3">
								<button type="button" data-action="ajout" data-produit="1<?php echo $menu["numProduit"]; ?>" class="btn btn-primary btnAjout">
									<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
								</button>
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

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>

<script src="js/carte.js?v=<?php echo filemtime('css/style.css'); ?>"></script>

<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
