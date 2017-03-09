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
		<!-- Si l'utilisateur n'a pas de produits favoris -->
			<?php
				if($estVide) {
			?>

		<!-- Affichage des produits seuls -->
			<?php
			} else {
				$i = 0;
				foreach($produitsFav as $produit) {
					if($i%3 == 0) echo '<div class="row">';
			?>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<div id="<?php echo $produit["numProduit"]; ?>" class="panel panel-default panel-product">
					<div class="media img-produit">
						<a href="#produitModal" data-toggle="modal"
									data-libelle="<?php echo $produit["libelle"]; ?>"
									data-source-img="<?php echo $produit['sourceMoyen'].".png"; ?>"
									data-description="<?php echo $produit["description"]; ?>"
									data-prix="<?php echo $produit["prix"]; ?>">
							<div class="media-top">
								<img src="<?php echo $produit["sourceMoyen"]; ?>.png" alt="Image <?php echo $produit["libelle"]; ?>" class="media-object img-thumbnail text-center">
							</div>
						</a>
						<div class="media-body">
								<h2 class="media-heading text-center push-down"><?php echo $produit["libelle"]; ?></h2>
								<p class="text-left desc-frame"><?php echo $produit["description"]; ?></p>
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
