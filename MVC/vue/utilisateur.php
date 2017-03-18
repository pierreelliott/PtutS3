<?php

	$title = "Mon compte";

	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-2 col-lg-8 site-wrapper">
			<h1>Mes informations</h1>

			<hr class="invisible-separator"/>

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="media">
						<div class="media-left media-top">
							<img src="images/user.png" alt="Avatar" class="media-object" style="width:150px">
						</div>
						<div class="media-body">
							<div class="row">
								<div class="col-sm-6">
									<p class="text-left text-primary italic"><?php echo $pseudo; ?>
										<a href="#" class="btn btn-primary btn-sm">
											<span class="glyphicon glyphicon-pencil"></span>
										</a>
									</p>
								</div>
								<div class="col-sm-6">
									<p class="pull-right text-muted italic small">Date d'inscription : <?php echo $dateInscription; ?> </p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<p class="text-dark text-left text-capitalize"><?php echo $prenom.' '.$nom; ?></p>
								</div>
								<div class="col-sm-offset-2 col-sm-4">
									<button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#modaleUtilisateur">Changer mon mot de passe</button>
								</div>
							</div>

							<!-- Début fenêtre modale -->

							<div class="modal fade" id="modaleUtilisateur">
							    <div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
											<h4 class="modal-title">Modifier mon mot de passe</h4>
										</div>
										<div class="modal-body">
											<form method="post" action="/modifMdpUser" id="modifMdp">
												<fieldset>
													<input type="hidden" id="pseudoModifMdp" name="pseudoModifMdp" value="<?= $pseudo ?>">
													<div class="form-group">
														<label for="oldMdp" class="label-form">Ancien mot de passe</label>
														<input type="password" id="oldMdp" name="oldMdp" class="form-control">
													</div>
													<div class="form-group">
														<label for="newMdp" class="label-form">Nouveau mot de passe</label>
														<input type="password" id="newMdp" name="newMdp" class="form-control">
													</div>
													<div class="form-group">
														<label for="confirmNewMdp" class="label-form">Confirmer mot de passe</label>
														<input type="password" id="confirmNewMdp" name="confirmNewMdp" class="form-control">
													</div>
												</fieldset>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
											<button type="submit" form="modifMdp" class="btn btn-primary">Modifier mon mot de passe</button>
										</div>
									</div>

							    </div>
						  	</div>

							<!-- Fin fenêtre modale -->

						</div>
					</div>

					<hr class="invisible-separator"/>

					<div class="row text-dark">
						<div class="col-sm-3">
							<p class="text-left"><strong>@ Adresse mail :</strong></p>
						</div>
						<div class="col-sm-6">
							<p class="text-left text-info"><?php echo $mail; ?></p>
						</div>
					</div>
					<div class="row text-dark">
						<div class="col-sm-3">
							<p class="text-left">
								<strong><span class="glyphicon glyphicon glyphicon-phone"></span>
								Téléphone :</strong>
							</p>
						</div>
						<div class="col-sm-6">
							<p class="text-left text-info"><?php echo $telephone; ?></p> <!-- Il faudrait formater l'affichage du numéro de tel -->
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-dark">
							<span class="glyphicon glyphicon-map-marker"></span> <strong>Adresse :</strong>
							<?php if(true) // Si l'adresse est renseignée
							{ ?>

								<?php if(true) { // Si l'adresse n'est pas valide (e.g. : champ null, ...) ?>
								 <span class="text-left text-warning italic small">Votre adresse n'est pas valide</span>
								 <?php } ?>

								<div class="row">
									<div class="col-sm-offset-1 col-sm-6">
										Rue : <span class="text-muted"><?php echo $rue; ?></span>
									</div>
									<div class="col-sm-3">
										N° : <span class="text-muted"><?php echo $numRue; ?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-offset-1 col-sm-6">
										Ville : <span class="text-muted"><?php echo $ville; ?></span>
									</div>
									<div class="col-sm-5">
										Code postal : <span class="text-muted"><?php echo $codePostal; ?></span>
									</div>
								</div>
							<?php
							} else { ?>
								<span class="text-left text-warning italic small">Vous n'avez pas renseigné d'adresse</span>
							<?php
							} ?>
						</div>
					</div>

					<hr class="invisible-separator"/>

					<div class="row">
						<div class="col-sm-offset-9 col-sm-3">
							<a href="#" class="btn btn-block btn-primary">Modifier mes informations</a>
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
