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
									<a href="#" class="pull-right btn btn-primary">Changer mon mot de passe</a>
								</div>
							</div>




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
