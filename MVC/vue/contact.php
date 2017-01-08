<?php
	$title = "Contactez-nous";

	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
        <div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<div class="row">
					<h1 class="col-lg-7">Informations de contact :</h1>
				</div>
				<div class="row">
					<dl>
						<dt class="col-lg-4">@ Adresse mail :</dt>
						<dd><a href="mailto:sushinos@sushis.net">sushinos@sushis.net</a></dd>
						<dt class="col-lg-4"><span class="glyphicon glyphicon glyphicon-phone"></span> Téléphone :</dt>
						<dd><a href="tel:+3304 45 56 67 78">04 45 56 67 78</a></dd>
						<dt class="col-lg-4"><span class="glyphicon glyphicon-map-marker"></span> Adresse :</dt>
						<dd>12 Rue de la Technologie, Villeurbanne</dd>
					</dl>
				</div>
				
				<div class="row">
					<h1 class="col-lg-5">Nous retrouver :</h1>
				</div>
				<div class="row embed-responsive embed-responsive-4by3">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2782.265148771866!2d4.880005115557931!3d45.78591547910611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4c01bf0a44f31%3A0x8f808af88cda1faa!2sIUT+LYON+1+-+Site+de+Villeurbanne+Doua!5e0!3m2!1sfr!2sfr!4v1483872337579" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				
				<!-- Pour le formulaire d'envoi de message -->
				<div class="row">
					<form  action="javascript:go('accueil')" method="post" accept-charset="utf-8">
						<fieldset>
							<legend>Contactez-nous :</legend>
							<div class="row">
								<div class="form-group has-error">
									<?php if(isset($message)) echo "<span class='help-block'>" . $message . "</span>"; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-offset-2 col-lg-8">
									<div class="form-group">
										<label for="mail" class="control-label">Adresse e-mail <span class="text-primary">(pour que nous puissions vous répondre)</span></label>
										<input type="text" id="mail" name="mail" placeholder="Adresse e-mail" class="form-control"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-offset-2 col-lg-8">
									<div class="form-group">
										<label for="message" class="control-label">Message</label>
										<textarea type="text" id="message" name="message" placeholder="Entrez votre message" class="form-control"/></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-offset-4 col-lg-4">
									<div class="form-group">
										<button type="submit" class="btn btn-success btn btn-success">Envoyer</button>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
        </div>
    </div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
