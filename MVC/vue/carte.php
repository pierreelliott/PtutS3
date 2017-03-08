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
		<div class="col-lg-offset-2 col-lg-8 site-wrapper">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
        <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
      </ul>
      <div class="tab-content">
		<!-- Affichage des produits seuls -->
        <div class="tab-pane fade in active push" id="produits">
			<hr class="invisible-separator"/>
			<?php
				$i = 0;
				foreach($carte as $produit) {
					if($i%3 == 0) echo '<div class="row">';
			?>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<div class="pull-left favori" onmouseover="hoverFavori()" onmouseout="outFavori()">
					<a href="/produits-favoris-<?php echo $produit["numProduit"]?>">
						<span class="glyphicon glyphicon-star-empty yellow"></span>
					</a>
				</div>
				<div id="<?php echo $produit["numProduit"]; ?>" class="panel panel-default panel-product">
					<div class="media img-produit">
						<a href="#produitModal" data-toggle="modal"
									data-libelle="<?php echo $produit["libelle"]; ?>"
									data-source-img="<?php echo $produit['sourceMoyen'].".png"; ?>"
									data-description="<?php echo $produit["description"]; ?>"
									data-prix="<?php echo $produit["prix"]; ?>">
							<div class="media-top">
								<img src="<?php echo $produit["sourceMoyen"]; ?>.png" alt="Image <?php echo $produit["libelle"]; ?>" class="media-object img-thumbnail center-block">
							</div>
						</a>
						<div class="media-body">
								<h2 class="media-heading text-center push-down"><?php echo $produit["libelle"]; ?></h2>
								<div class="desc-frame"><p class="text-left"><?php echo $produit["description"]; ?></p></div>
							<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-success btn-block btnAjout">
								<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
							</button>
							<p class="">Prix : <?php echo $produit["prix"]; ?> €</p>
						</div>
					</div>
				</div>
			</div>
			<?php
				$i+=1;
				if($i%3 == 0) echo '</div>';
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
			<hr class="invisible-separator"/>
          <?php
		  foreach($menus as $menu)
			{
			?>
				<div class="panel panel-default panel-menu">
					<div class="panel-header">
						<div class="row">
							<h2 class="menu-heading">Menu "<?php echo $menu["libelle"]; ?>"</h2>
						</div>
						<div class="row">
							<div class="col-sm-offset-1 col-lg-7 col-md-7 col-sm-7">
								<p class="desc-frame text-left"><?php echo $menu["description"]; ?></p>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p class="text-center">Prix : <?php echo $menu["prix"]; ?> €</p>
								<button type="button" data-action="ajout" data-produit="1<?php echo $menu["numProduit"]; ?>" class="btn btn-block btn-success btnAjout">
									<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
								</button>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
						<?php
						$i = 0;
						foreach($menu["produits"] as $produit)
						{
						?>
						<div class="col-md-4">
							<div class="panel panel-default panel-menu-product">
                                <a data-container="body" data-toggle="popover" data-trigger="click" title="<p class='text-muted'><?php echo $produit["libelle"] ?></p>" data-content="<p class='text-muted'><?php echo $produit["description"] ?></p>" data-placement="auto right" data-html="true">
									<div class="panel-heading">
										<p class="text-muted"><?php echo $produit["libelle"]; ?></p>
									</div>
									<div class="panel-body">
										<img src="<?php echo $produit["sourceMoyen"]; ?>.png" alt="Image <?php echo $produit["libelle"] ?>" class="img-responsive" style="width:80px">
									</div>
                                </a>
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
