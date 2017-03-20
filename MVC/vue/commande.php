<?php
    $title = "Commande du ".$dateCommande;

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-13">
				<div class="row">
					<div class="panel panel-default" style="color:black">
						<div class="panel-heading">
							<h1>Commande du <?php echo $dateCommande;?></h1>
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
											<?php $i = 0; foreach ($produits as  $produit) { ?>

											<?php
											// Si le "produit" n'est pas un menu
											if(true) { ?>
											<li class="list-group-item">
												<div class="row">
													<div class="col-sm-2">
														<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
													</div>
													<div class="col-sm-10">
														<div class="row">
															<div class="col-sm-5">
																<p><?php echo $produit["libelle"]; ?></p>
															</div>
															<div class="col-sm-5">
																<p>Prix unitaire : <?php echo $produit["prix"]; ?> €</p>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-offset-4 col-sm-5">
																<p>Quantité : <?php echo $produit["quantite"]; ?></p>
															</div>
															<div class="col-sm-3">
																<p>Prix : <?php echo $produit["prixTotal"]; ?> €</p>
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
														<p><?php echo $produit["libelle"]; ?></p>
													</div>
													<div class="col-sm-5">
														<p>Prix unitaire : <?php echo $produit["prix"]; ?> €</p>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-offset-4 col-sm-5">
														<p>Quantité : <?php echo $produit["quantite"]; ?></p>
													</div>
													<div class="col-sm-3">
														<p>Prix : <?php echo $produit["prixTotal"]; ?> €</p>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-8">
														<div class="panel-group">
															<div class="panel panel-default">
																<div class="panel-heading">
																	<h4 class="panel-title">
																		<a data-toggle="collapse" href="#collapseMenu<?php echo "".$i; //Vaudrait mieux mettre le numProduit ?>">Produits du menu</a>
																	</h4>
																</div>
																<div id="collapse2" class="panel-collapse collapse">
																	<ul class="list-group">
																		<?php foreach ($variable as $key => $value) { ?>
																		<li class="list-group-item">
																			<div class="row">
																				<div class="col-sm-2">
																					<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
																				</div>
																				<div class="col-sm-4">
																					<p><?php echo $produit["libelle"]; ?></p>
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
											<?php
												} $i++;
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
											<?php foreach ($produits as  $produit) { ?>
											<li class="list-group-item">
												<div class="row">
													<div class="col-sm-2">
														<img src="<?php echo $produit["sourcePetit"]; ?>" alt="Image <?php echo $produit["libelle"]; ?>" class="img-responsive">
													</div>
													<div class="col-sm-10">
														<div class="row">
															<div class="col-sm-5">
																<p><?php echo $produit["libelle"]; ?></p>
															</div>
															<div class="col-sm-5">
																<p>Prix unitaire : <?php echo $produit["prix"]; ?> €</p>
															</div>
														</div>
														<div class="row">
															<div class="col-sm-offset-4 col-sm-5">
																<p>Quantité : <?php echo $produit["quantite"]; ?></p>
															</div>
															<div class="col-sm-3">
																<p>Prix : <?php echo $produit["prixTotal"]; ?> €</p>
															</div>
														</div>
													</div>
												</div>
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>

						</div>
						<div class="panel-footer">
							<div>
								<h1>Prix total : <?php echo $prixCommande;?> €</h1>
							</div>
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
