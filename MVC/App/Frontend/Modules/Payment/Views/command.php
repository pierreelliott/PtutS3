<div class="row">
	<div class="col-lg-offset-3 col-lg-6 site-wrapper">
        <div class="row">
            <div class="col-sm-4">
                <a class="btn btn-block btn-success" href="/historique-commandes">Revenir à l'historique</a>
            </div>
        </div>
		<div class="row">
			<div class="panel panel-default" style="color:black">
				<div class="panel-heading">
					<h1>Commande du <?= $dateCommande ?></h1>
				</div>
                <!-- Affichage du produit -->
				<div class="panel-body">

					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapse1">
										<span class="glyphicon glyphicon-chevron-down"></span>
										Produits commandés
									</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse in">
								<ul class="list-group">
									<?php $i = 0;
                                        foreach ($produits as  $produit) {
    										// Si le "produit" n'est pas un menu
    										if(!$produit["estMenu"]) { ?>
        										<li class="list-group-item">
        											<div class="row">
        												<div class="col-sm-2">
        													<img src="<?= $produit['sourcePetit'] ?>" alt="Image <?= $produit['libelle'] ?>" class="img-responsive">
        												</div>
        												<div class="col-sm-10">
        													<div class="row">
        														<div class="col-sm-5">
        															<p><?= $produit['libelle'] ?></p>
        														</div>
        														<div class="col-sm-7">
        															<p class="text-muted text-left">Prix unitaire : <?= $produit['prix'] ?> &euro;</p>
        														</div>
        													</div>
        													<div class="row">
        														<div class="col-sm-5">
        															<p>Quantité : <?= $produit['quantite'] ?></p>
        														</div>
        														<div class="col-sm-7">
        															<p class=" text-left">Prix : <?= $produit['prixTotal'] ?> &euro;</p>
        														</div>
        													</div>
        												</div>
        											</div>
        										</li>
    										<?php
    										} else {
    											// Si le "produit" n'est pas un menu
    											// (Il faut changer le nom des variables)
    										?>
        										<li class="list-group-item">
        											<div class="row">
        												<div class="col-sm-5">
        													<p><?= $produit['libelle'] ?></p>
        												</div>
        												<div class="col-sm-5">
        													<p class="text-muted">Prix unitaire : <?= $produit['prix'] ?> €</p>
        												</div>
        											</div>
        											<div class="row">
        												<div class="col-sm-offset-4 col-sm-5">
        													<p>Quantité : <?= $produit['quantite'] ?></p>
        												</div>
        												<div class="col-sm-3">
        													<p>Prix : <?= $produit['prixTotal'] ?> €</p>
        												</div>
        											</div>
        											<div class="row">
        												<div class="col-sm-8">
        													<div class="panel-group">
        														<div class="panel panel-default">
        															<div class="panel-heading">
        																<h4 class="panel-title">
        																	<a data-toggle="collapse" href="#collapseMenu<?= "".$i // Vaudrait mieux mettre le numProduit ?>">Produits du menu</a>
        																</h4>
        															</div>
        															<div id="collapse2" class="panel-collapse collapse">
        																<ul class="list-group">
        																	<?php foreach ($variable as $key => $value) { ?>
            																	<li class="list-group-item">
            																		<div class="row">
            																			<div class="col-sm-2">
            																				<img src="<?= $produit['sourcePetit'] ?>" alt="Image <?= $produit['libelle'] ?>" class="img-responsive">
            																			</div>
            																			<div class="col-sm-4">
            																				<p><?= $produit['libelle'] ?></p>
            																			</div>
            																		</div>
            																	</li>
        																	<?php } ?>
        																</ul>
        															</div>
        														</div>
        													</div>
        												</div>
        											</div>
        										</li>
    										<?php }
                                            $i++;
										} ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#collapseInfos">
										<span class="glyphicon glyphicon-chevron-down"></span>
										Informations sur la commande
									</a>
								</h4>
							</div>
							<div id="collapseInfos" class="panel-collapse collapse in">
								<ul class="list-group">
									<li class="list-group-item">
										<div class="row">
											<div class="col-sm-12">
												<p>Type de commande : <span class="text-info">À emporter</span></p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

				</div>
				<div class="panel-footer">
					<div>
						<h1>Prix total : <?= $prixCommande ?> &euro;</h1>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
