<?php
	$title = "S'inscrire";
	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="row">
				<form action="/PtutS3/MVC/inscription" method="post" name="inscription" accept-charset="utf-8">
					<fieldset>
						<legend>Inscription à Sushinos</legend>
						<input type="hidden" name="page" value="inscription"/>
						<span class="help-block lead">Les champs avec <span class="text-danger">*</span> sont obligatoires</span>
						<div class="form-group has-error">
							<?php if(isset($message)) echo "<span class='help-block'>".$message."</span>"; ?>
						</div>
						<div class="row">
							<div class="col-xs-offset-2 col-xs-8">
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="nom" class="control-label">Nom <span class="text-danger">*</span></label>
											<input type="text" id="nom" name="nom" placeholder="Nom" class="form-control" required/>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="prenom" class="control-label">Prénom <span class="text-danger">*</span></label>
											<input type="text" id="prenom" name="prenom" placeholder="Prénom" class="form-control" required/>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="pseudo" class="control-label">Pseudo <span class="text-danger">*</span></label>
											<input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="form-control" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="numRue" class="control-label">N°rue</label>
											<input type="number" id="numRue" name="numRue" placeholder="N°rue" class="form-control"/>
										</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group">
											<label for="rue" class="control-label">Rue</label>
											<input type="text" id="rue" name="rue" placeholder="Nom de rue" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label for="codePostal" class="control-label">Code postal</label>
											<input type="text" id="codePostal" name="codePostal" placeholder="Code postal" class="form-control"/>
										</div>
									</div>
									<div class="col-lg-8">
										<div class="form-group">
											<label for="ville" class="control-label">Ville</label>
											<input type="text" id="ville" name="ville" placeholder="Ville" class="form-control"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-8">
										<div class="form-group">
											<label for="email" class="control-label">Adresse mail <span class="text-danger">*</span></label>
											<input type="email" id="email" name="email" placeholder="Adresse e-mail" class="form-control" required/>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label for="tel" class="control-label">Téléphone <span class="text-danger">*</span></label>
											<input type="tel" id="tel" name="tel" placeholder="Téléphone" class="form-control" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="mdpConfirm" class="control-label">Confirmer mot de passe <span class="text-danger">*</span></label>
											<input type="password" id="mdpConfirm" name="mdpConfirm" placeholder="Confirmer mot de passe" class="form-control" required/>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="mdp" class="control-label">Mot de passe <span class="text-danger">*</span></label>
											<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="form-control" required/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-offset-8 col-lg-4">
										<div class="form-group">
											<button type="submit" class="btn btn-success btn-block pull-right">Inscription</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
