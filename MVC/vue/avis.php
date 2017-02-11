<?php
    $title = "Avis des utilisateurs du site";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<div class="row">
                    <div class="form-group has-error">
                        <?php if(isset($message)) echo "<span class='help-block'>" . $message . "</span>";
                        else { ?>
                    </div>
					<form action="index.php?page=avis" method="post" name="avisUtilisateur" accept-charset="utf-8">
						<fieldset>
							<legend>Donnez votre avis sur nos services</legend>
							<div class="row">

							</div>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label for="commentaire" class="control-label">Commentaire :</label>
										<textarea type="text" id="commentaire" name="commentaire"
                                        <?php  //Affichage de l'avis deja existant si il y en a un
                                        if($userAvis != false)
                                        {
                                            echo "placeholder='".$userAvis['avis']."'";
                                        }
                                        else {
                                            echo "placeholder='Entrez votre commentaire'";
                                        }
                                        ?> class="form-control vresize"></textarea>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<button type="submit" class="btn btn-success btn-block">Poster mon avis</button>
									</div>
								</div>
							</div>
						</fieldset>
					</form>
                    <?php } ?>
				</div>
				<?php
				foreach($tousAvis as $avis)
				{
				?>
					<div class="panel panel-default">
						<div class="media">
							<div class="media-left media-top">
								<img src="images/user.png" class="media-object" style="width:80px">
							</div>
							<div class="media-body">
								<h2 class="media-heading text-muted"><?php echo $avis['pseudo']; ?></h2>
								<p class="text-muted pull-left">Note : <?php echo $avis['note']; ?></p>
								<p class="text-muted">Commentaire: <?php echo $avis['avis']; ?></p>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-lg-1">
									<a href="#"><img src="images/signaler.png" alt="Pouce bleu" class="img-responsive"/></a>
								</div>
								<div class="col-lg-offset-7 col-lg-1">
									<a href="#"><img src="images/pouce_bleu.png" alt="Pouce bleu" class="img-responsive"/></a>
								</div>
								<div class="col-lg-1">
                                    <?php echo $avis["pouceBleu"]; ?>
								</div>
								<div class="col-lg-1">
									<a href="#"><img src="images/pouce_rouge.png" alt="Pouce bleu" class="img-responsive"/></a>
								</div>
								<div class="col-lg-1">
                                    <?php echo $avis["pouceRouge"]; ?>
								</div>
							</div>
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
