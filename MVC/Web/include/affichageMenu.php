<div class="panel panel-default panel-menu">
	<?php if(isset($admin) && $admin == true) { ?>
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
	<?php } ?>
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
				<button type="button" data-action="ajout" data-produit="<?php echo $menu["numProduit"]; ?>" class="btn btn-block btn-success btnAjout">
					<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
				</button>
			</div>
		</div>
	</div>
	<div class="panel-body row">
		<?php
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
						<img src="<?php echo $produit["sourceMoyen"]; ?>" alt="Image <?php echo $produit["libelle"] ?>" class="img-responsive" style="width:80px">
					</div>
				</a>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</div>
