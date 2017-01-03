<?php

	$title = "Mon panier";

	ob_start();

	if($this->panier->estVide())
	{
?>
<!-- ======== Début Code HTML ======== -->
<!-- Panier vide -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<p>Votre panier est vide</p>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	} else {
?>
<!-- ======== Début Code HTML ======== -->
<!-- Panier rempli -->
<!--
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<table class="table table-hover">
				<tbody>
					<tr>
						<th>Produit</th>
						<th>Quantité</th>
						<th>Prix unitaire (€)</th>
						<th>Prix total (€)</th>
						<th>Retirer du panier</th>
					</tr>
					
					<?php
						foreach($_SESSION["panier"] as $numProduit => $produit) {
					?>
					<tr>
						<td><?php echo $produit["libelle"]; ?></td>
						<td><?php echo $produit["quantite"]; ?></td>
						<td><?php echo $produit["prix"]; ?></td>
						<td><?php echo $this->panier->getPrixTotalProduit($numProduit); ?></td>
						<td><a href='<?php echo 'index.php?page=panier&action=suppression&produit='.$numProduit.','.implode(',', $produit); ?>'><img src="images/mooins2.png" alt="Retirer du panier" title="Retirer du panier"/></a></td>
					</tr>
					<?php
						}
					?>

					<tr>
						<td>Total</td>
						<td><?php echo $this->panier->getQteTotale(); ?></td>
						<td></td>
						<td><?php echo $this->panier->getPrixPanier(); ?></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
-->
<!-- ======== Fin Code HTML ======== -->


<!-- ======== Début Code HTML ======== -->
<!-- Nouvel affichage -->
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div>
				<legend>Votre panier</legend>
				<div class="row">
					<?php
						foreach($_SESSION["panier"] as $numProduit => $produit) {
					?>
					<!--<tr>
						<td><?php echo $produit["libelle"]; ?></td>
						<td><?php echo $produit["quantite"]; ?></td>
						<td><?php echo $produit["prix"]; ?></td>
						<td><?php echo $this->panier->getPrixTotalProduit($numProduit); ?></td>
						<td><a href='<?php echo 'index.php?page=panier&action=suppression&produit='.$numProduit.','.implode(',', $produit); ?>'><img src="images/mooins2.png" alt="Retirer du panier" title="Retirer du panier"/></a></td>
					</tr>-->
					<div class="col-xs-12 produit">
						<div class="row">
							<div class="col-xs-2">
								<img src="<?php echo $produit["source"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
							</div>	
							<div class="col-xs-3">
								<p><?php echo $produit["libelle"]; ?></p>
							</div>
							<div class="col-xs-1">
								<a href="index.php?page=panier&action=ajout&produit=<?php echo $numProduit.','.implode(',', $produit); ?>" class="btn btn-xs btn-primary btn-qte-produit">+</a>
							</div>
							<div class="col-xs-1">
								<p><?php echo $produit["quantite"]; ?></p>
							</div>
							<div class="col-xs-1">
								<a href="#" class="btn btn-xs btn-primary">-</a>
							</div>
							<div class="col-xs-3">
								<p><?php echo $produit["prix"]; ?> €</p>
							</div>
							<div class="col-xs-1">
								<a href="<?php echo 'index.php?page=panier&action=suppression&produit='.$numProduit.','.implode(',', $produit); ?>" class="btn btn-danger">&times;</a>
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
				<div class="row">
					<p>Prix du panier : <?php echo $this->panier->getPrixTotalProduit($numProduit); ?> €</p>
				</div>
			</div>
		</div>
	</div>
<!-- ======== Fin Code HTML ======== -->
<?php
	}

	$contenu = ob_get_clean();

	require("layout/site.php");
?>