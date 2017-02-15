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
                        <?php //Si il y a message d'erreur causé par les votes
                        if(isset($erreur)) echo "<span class='help-block'>" . $erreur . "</span>";
                        if(isset($message)) echo "<span class='help-block'>" . $message . "</span>";
                        else {
                            if(isset($erreur)) echo "<span class='help-block'>".$erreur."</span>";?>
                    </div>
					<form action="/add-avis" method="post" name="avisUtilisateur" accept-charset="utf-8">
						<fieldset>
							<legend>Donnez votre avis sur nos services</legend>
							<div class="row">

							</div>
							<div class="row">
								<div class="col-lg-8">
									<div class="form-group">
										<label for="commentaire" class="control-label">Commentaire :</label>
										<textarea type="text" id="commentaire" name="commentaire"
                                            <?php
                                            //Affichage de l'avis deja existant si il y en a un
                                            if($userAvis != false)
                                            {
                                                echo "placeholder='".$userAvis['avis']."'";
                                            }
                                            else {
                                                echo "placeholder='Entrez votre commentaire'";
                                            }
                                            ?> class="form-control vresize">
                                        </textarea>
                                        <label for="note" class="control-label">Note :</label>
                                        <input type="number" name="note" class="text-muted"  >
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
                                    <!-- Lien vers la fenetre modale !-->
									<a href='#signalModal'
                                        data-toggle='modal'
                                        data-numAvis="<?php echo $avis["numuser"]; ?>"
                                        data-pseudo="<?php echo $avis["pseudo"]; ?>"
                                        data-commentaire-avis="<?php echo $avis['avis']; ?>">
                                        <img src="images/signaler.png" alt="Signaler l'avis" class="img-responsive"/>
                                    </a>
								</div>
								<div class="col-lg-offset-7 col-lg-1">
									<a <?php echo "href='/vote-1-{$avis['numuser']}'"; ?>>
                                        <img src="images/pouce_bleu.png" alt="Pouce bleu" class="img-responsive"/>
                                    </a>
								</div>
								<div class="col-lg-1">
                                    <?php echo $avis["pouceBleu"]; ?>
								</div>
								<div class="col-lg-1">
									<a <?php echo "href='/vote-0-{$avis['numuser']}'"; ?>>
                                        <img src="images/pouce_rouge.png" alt="Pouce rouge" class="img-responsive"/>
                                    </a>
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

    <!-- Affichage de la fenetre modale du signalement !-->
    <div class="modal fade" id="signalModal">
      <div class="modal-dialog">
        <form method="post" action="/signalAvis">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4>Signaler</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-xs-6">
                    <h4>Commentaire de l'avis: </h4>
                    <blockquote>
                        <span class="commentaireAvis"></span>
                        <footer class="modal-pseudo"></footer>
                    </blockquote>
                  </div>

                </div>
                <div class="form-group">
                    <label for="remarque" class="control-label">Remarque:</label>
                    <textarea class="form-control vresize" type="text" name="remarque" placeholder="Entrer une remarque"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-success">Signaler l'avis</button>
                </div>
            </div>
        </form>
      </div>
    </div>

<!-- ======== Fin Code HTML ======== -->
<?php

	$contenu = ob_get_clean(); ?>

<script language="javascript" src="js/avis.js"></script>

<?php
$script = ob_get_clean();
require("layout/site.php");?>
