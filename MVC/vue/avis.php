<?php
    $title = "Avis des utilisateurs du site";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<div class="row">
					<form action="index.php?page=avis" method="post" name="avisUtilisateur" accept-charset="utf-8">
						<fieldset>
							<legend>Donnez votre avis sur nos services</legend>
							<div class="row">
								<div class="form-group has-error">
									<?php if(isset($message)) echo "<span class='help-block'>" . $message . "</span>"; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label for="commentaire" class="control-label">Commentaire :</label>
										<textarea type="text" id="commentaire" name="commentaire" placeholder="Ecrivez votre commentaire ici" class="form-control"></textarea>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<button type="submit" class="btn btn-success btn btn-success">Poster mon avis</button>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<?php
				for($i = 1; $i <= 6; $i++)
				{
				?>
					<div class="panel panel-default">
						<div class="media">
							<div class="media-left media-top">
								<img src="images/user.png" class="media-object" style="width:80px">
							</div>
							<div class="media-body">
								<h2 class="media-heading text-muted">Utilisateur</h2>
								<p class="text-muted pull-left">Commentaire [...........]</p>
								<p class="text-muted">Note : * * * * *</p>
							</div>
						</div>
						<div class="panel-footer">
							Coucou
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
<!-- ======== Fin Code HTML ======== -->
<?php

	$contenu = ob_get_clean();
	
	require("layout/site.php");
?>