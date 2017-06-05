<div class="col-sm-4">

	<?php if(!isset($admin) || (isset($admin) && $admin == false)) {
		if($user->isAuthenticated()) { ?>
		<!-- Etoile pour les produits favoris
	 			(cachée dans l'interface d'administration) -->
	<div class="pull-left favori">
		<a href="/produits-favoris-<?= $produit['numProduit'] ?>">
		<?php if(isset($produit['favori']) && $produit['favori'] == true) {
			echo '<span class="glyphicon glyphicon-star yellow"></span>';
		} else {
			echo '<span class="glyphicon glyphicon-star-empty yellow"></span>';
		} ?>
		</a>
	</div>
	<?php }
	} ?>

	<div id="<?= $produit['numProduit'] ?>" class="panel panel-default panel-product">

		<?php if(isset($admin) && $admin == true) { ?>
		<!-- Boutons d'administration -->
		<div class="panel-heading text-right">
			<!-- Bouton modifier produit -->
			<span data-toggle="tooltip" data-placement="top" title="Modifier produit">
				<button type="button" class="glyphicon glyphicon-pencil btn btn-primary btn-admin modifProduit" data-toggle="modal" data-target="#adminProduitModif" data-num-produit="<?= $produit['numProduit'] ?>"></button>
			</span>
			<!-- Bouton supprimer produit -->
			<span data-toggle="tooltip" data-placement="top" title="Supprimer produit">
				<button type="button" class="glyphicon glyphicon-remove btn btn-danger btn-admin supprProduit" data-toggle="modal" data-target="#adminProduitSuppr" data-num-produit="<?= $produit['numProduit'] ?>"></button>
			</span>
		</div>
		<?php } ?>

		<div class="media img-produit">
			<a href="#produitModal" data-toggle="modal"
						data-libelle="<?= $produit['libelle'] ?>"
						data-source-img="<?= $produit['sourceMoyen'] ?>"
						data-description="<?= $produit['description'] ?>"
						data-prix="<?= $produit['prix'] ?>">
				<div class="media-top">
					<img src="<?= $produit['sourceMoyen'] ?>" alt="Image <?= $produit['libelle'] ?>" class="media-object img-thumbnail center-block">
				</div>
			</a>
			<div class="media-body">
				<h2 class="media-heading text-center push-down"><?= $produit['libelle'] ?></h2>
				<div class="desc-frame"><p class="text-left"><?= mb_strimwidth($produit['description'], 0, 25, '...') ?></p></div>
				<button type="button" data-action="ajout" data-produit="<?= $produit['numProduit'] ?>" class="btn btn-success btn-block btnAjout">
					<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
				</button>
				<p class="">Prix : <?= $produit['prix'] ?> €</p>
			</div>
		</div>
	</div>
</div>
