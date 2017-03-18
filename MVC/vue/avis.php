<?php
    $title = "Avis des utilisateurs du site";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->
    <div class="alert alert-danger hidden">
      Vous avez déja signalé cet avis !!!
    </div>
	<div class="row">
		<div class="col-lg-offset-2 col-lg-8 site-wrapper">
			<div class="col-lg-12">
				<div class="row">

                        <?php //Si il y a message d'erreur causé par les votes
                        if(isset($message))
                        {
                            echo "<div class='form-group has-error'>
                                    <span class='help-block'>" . $message . "</span>
                                </div>";
                        }
                        else {
                            ?>
					<h1>Donnez votre avis sur nos services</h1>

					<hr class="invisible-separator"/>

					<div class="row">
						<div class="col-sm-offset-1 col-sm-10">
							<div class="panel panel-info">
								<div class="panel-body">
									<form action="/add-avis" method="post" name="avisUtilisateur" accept-charset="utf-8">
										<fieldset>
											<div class="row">
												<div class="col-lg-8">
													<div class="form-group">
														<label for="commentaire" class="control-label text-dark">Commentaire :</label>
														<?php //Affichage de l'avis deja existant si il y en a un
														if($userAvis != false) { ?>
															<textarea id="commentaire" name="commentaire" class="form-control vresize"><?=$userAvis['avis']?></textarea>
														<?php
														}else { ?>
															<textarea id="commentaire" name="commentaire" class="form-control vresize" placeholder="Entrez votre commentaire"></textarea>
														<?php } ?>

				                                        <label for="note" class="control-label text-dark">Note :</label>

				                                        <div id="etoiles">
				                                        </div>
				                                        <input type="hidden" name="note" id="noteInput" value="0">

				                                        <input  id="valNow" type="hidden" name="noteNow" class="text-muted" value="<?php echo $userAvis['note'];?>">
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
								</div>
							</div>
						</div>
					</div>

                    <?php } ?>

				<?php
				foreach($tousAvis as $avis)
				{
				?>

					<div class="panel panel-default">
						<div class="panel-body">
							<div class="media">
								<div class="media-left media-top">
									<img src="images/user.png" alt="Avatar" class="media-object img-circle" style="width:80px">
								</div>
								<div class="media-body">
									<p class="text-left text-primary italic"><?php echo $avis['pseudo']; ?></p>
									<p class="text-left text-muted small italic"> - Posté le <?php echo "$avis['date']"; ?></p>
								</div>
							</div>
							<hr class="invisible-separator"/>
							<div class="desc-frame">
								<p class="text-left">
									<?php
									for($i = 0; $i < $avis['note']/2; $i++)
									{
										echo "<span class='glyphicon glyphicon-star yellow'></span>";
									}
									for (; $i < 5 ; $i++) {
										echo "<span class='glyphicon glyphicon-star-empty yellow'></span>";
									}
									 ?></p>
								<?php if(true) { // Si il y a un commentaire
								 ?>
								<p class="text-dark text-left">Commentaire: <?php echo $avis['avis']; ?></p>
								<?php } ?>
							</div>
							<hr class="invisible-separator"/>
							<div class="row">
								<?php  //Si l'utilisateur est connecté
                                if(!isset($message))
                                { ?>
    								<div class="col-sm-1">
                                        <!-- Lien vers la fenetre modale !-->
    									<a href='#signalModal'
                                            data-toggle='modal'
                                            data-num-avis="<?php echo $avis["numuser"]; ?>"
                                            data-pseudo="<?php echo $avis["pseudo"]; ?>"
                                            data-commentaire-avis="<?php echo $avis['avis']; ?>">
                                            <img src="images/signaler.png" alt="Signaler l'avis" class="img-responsive"/>
                                        </a>
    								</div>
                                <?php } ?>
								<div class="col-sm-offset-7 col-sm-2">
									<a class="btn-primary btn" <?php echo "href='/vote-1-{$avis['numuser']}'"; ?>>
										<span class="glyphicon glyphicon-thumbs-up"></span>
										<span class="badge"><?php echo $avis["pouceBleu"]; ?></span>
                                    </a>
								</div>
								<div class="col-sm-1">
									<a class="btn-danger btn" <?php echo "href='/vote-0-{$avis['numuser']}'"; ?>>
										<span class="glyphicon glyphicon-thumbs-down"></span>
										<span class="badge"><?php echo $avis["pouceRouge"]; ?></span>
                                    </a>
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
	</div>

    <!-- Affichage de la fenetre modale du signalement -->
    <div class="modal fade" id="signalModal">
      <div class="modal-dialog">
        <form method="post" id="formSignal">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4>Signaler</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-xs-6">
                    <h4>Commentaire de l'avis :</h4>
                    <blockquote>
                        <span class="commentaireAvis"></span>
                        <footer class="modal-pseudo"></footer>
                    </blockquote>
                  </div>
                </div>
                <input type="hidden" name="numAvis" id="numAvis" value="">
                <div class="form-group">
                    <label for="remarque" class="control-label">Remarque :</label>
                    <textarea class="form-control vresize" id="remarque" name="remarque" placeholder="Entrer une remarque"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <div class="col-xs-4">
                    <button type="button" id="btnSignal" class="btn btn-success">Signaler l'avis</button>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>

<!-- ======== Fin Code HTML ======== -->
<?php

	$contenu = ob_get_clean(); ?>

<script src="js/notes.js?v=<?php echo filemtime('css/style.css'); ?>"></script>
<script src="js/avis.js?v=<?php echo filemtime('css/style.css'); ?>"></script>
<script src="js/afficheNote.js?v=<?php echo filemtime('css/style.css'); ?>"></script>

<?php
$script = ob_get_clean();
require("layout/site.php");?>
