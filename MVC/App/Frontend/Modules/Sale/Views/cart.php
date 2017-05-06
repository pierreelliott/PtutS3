<div class="row">
	<div class="col-lg-offset-3 col-lg-6 site-wrapper">
		<div class="panier">
		<?php if($estVide) { ?>
			<div class="row">
				<h1>Votre panier est vide</h1>
			</div>
			<hr/>
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<a class="btn btn-success btn-block" href="/menu"><h2>Commander quelque chose !</h2></a>
				</div>
			</div>
		<?php } else { ?>
			<legend>Votre panier</legend>
			<div class="row">

				<?php foreach($produits as $numProduit => $produit) { ?>

					<div id="<?= $numProduit ?>" class="panel panel-default">

						<div class="media img-produit">
							<div class="media-left media-top">
								<img src="<?= $produit["sourceMoyen"] ?>" alt="Image <?= $produit["libelle"] ?>" class="media-object img-thumbnail" style="width:80px">
							</div>
							<div class="media-body">
								<h2 class="media-heading text-muted"><?= $produit["libelle"] ?></h2>
								<p class="text-muted pull-left"><?= $produit["description"] ?></p>
								<p class="text-muted">Prix : <?= $produit["prix"] ?>€</p>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-xs-offset-2 col-xs-1"> <!-- Enlever une occurrence -->
									<button type="button" data-action="modification" data-produit="<?= $numProduit ?>" data-qte="-1" class="btn btn-xs btn-primary btn-qte-produit">-</button>
								</div>
								<div class="col-xs-3">
									<p class="qte">Quantité : <?= $produit["quantite"] ?></p>
								</div>
								<div class="col-xs-1"> <!-- Ajouter une occurrence -->
									<button type="button" data-action="modification" data-produit="<?= $numProduit ?>" data-qte="1" class="btn btn-xs btn-primary btn-qte-produit">+</button>
								</div>
								<div class="col-xs-2">
									<p class="prixNow"><?= $produit["prix"]*$produit["quantite"] ?> €</p>
								</div>
								<div class="col-xs-1">
									<button type="button" data-action="suppression" data-produit="<?= $numProduit ?>" class="btn btn-xs btn-danger btn-qte-produit">&times;</button>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
			<div class="row">
				<p class="prix">Prix du panier : <?= $prixTotal ?> €</p>
			</div>
			<hr/>
			<div class="row">
				<?php if($user->isAuthenticated()) { ?>
					<div class="col-lg-4 col-lg-offset-8">
						<a class="btn btn-success btn-block" href="/paiement">Payer ma commande</a>
					</div>
				<?php } else { ?>
					<div class="col-lg-6 col-lg-offset-6">
						<a class="btn btn-danger btn-block" href="/connect">Veuillez vous connecter pour pouvoir commander</a>
					</div>
				<?php } ?>
			</div>

		<?php } ?>

		</div>
	</div>
</div>

<!--<script src="js/panier.js"></script>-->
