<?php
    $title = "Recapitulatif de la Commande";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-13">
				<div class="row">
					<div class="panel panel-default" style="color:black">
						<div class="panel-heading">
							<h1>Votre Commande</h1>
						</div>
                        <!-- Affiche les colonnes du panel -->
                        <div class="panel-body colonne-produit">
							<div class="col-xs-12 produit">
								<div class="row produit-ligne-separateurs">
									<div class="col-xs-2">
										<p>Image Produit</p>
									</div>
									<div class="col-xs-3">
										<p>Nom Produit</p>
									</div>
									<div class="col-xs-2">
										<p>Prix Unitaire</p>
									</div>
									<div class="col-xs-3">
										<p>Quantite</p>
									</div>
									<div class="col-xs-2">
										<p>Prix total</p>
									</div>
								</div>
							</div>
						</div>
                        <!-- Affichage du produit -->
						<div class="panel-body">
							<?php
							foreach($produits as  $produit) {
							?>
								<div class="col-xs-12 produit">
									<div class="row produit-ligne-separateurs">
										<div class="col-xs-2">
											<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
										</div>
										<div class="col-xs-3">
											<p><?php echo $produit["libelle"]; ?></p>
										</div>
										<div class="col-xs-2">
											<p><?php echo $produit["prix"]; ?> €</p>
										</div>
										<div class="col-xs-offset-1 col-xs-2">
											<p><?php echo $produit["quantite"]; ?></p>
										</div>
										<div class="col-xs-2">
											<p><?php echo $produit["prixTotal"]; ?> €</p>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
						<div class="panel-footer">
							<div>
								<h1>Prix total : <?php echo $prixCommande;?> €</h1>
							</div>
						</div>
                        <div>
                            <form action="/paiement-paypal" method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="typeCommande" class="control-label col-lg-6">Sélectionnez le type de la commande</label>
                                    <div class="col-lg-5">
                                        <select name="typeCommande" id="typeCommande" class="form-control">
                                            <option value="A Emporter">À emporter</option>
                                            <option value="Livraison">Livraison</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="prix" value="<?php echo $prixCommande;?>">
                                <button class="btn btn-success" type="submit">Payer via Paypal</button>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- ======== Fin Code HTML ======== -->
<?php

	$contenu = ob_get_clean();

	require("layout/site.php");
?>
