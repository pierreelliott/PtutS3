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
				<div class="desc-frame"><p class="text-left"><?php echo mb_strimwidth($produit["description"], 0, 25, "..."); ?></p></div>
				<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-success btn-block btnAjout">
					<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
				</button>
				<p class="">Prix : <?php echo $produit["prix"]; ?> €</p>
			</div>
		</div>
	</div>
</div>
