<div class="alert alert-danger hidden">
    Vous avez déja signalé cet avis !
</div>
<div class="row">
    <div class="col-lg-offset-2 col-lg-8 site-wrapper">
        <div class="col-lg-12">
            <div class="row">

                <?php // Si il y a message d'erreur causé par les votes
                if($message != null) {
                ?>
                    <div class='form-group has-error'>
                        <span class='help-block'><?= $message ?></span>
                        <a href="/connect" class="btn btn-info">Se connecter</a>
                    </div>

                <?php } else { ?>

                    <h1>Donnez votre avis sur nos services</h1>

                    <hr class="invisible-separator"/>

                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="panel panel-info">
                                <div class="panel-body">
                                    <form action="/add-advice" method="post" name="avisUtilisateur" accept-charset="utf-8">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="commentaire" class="control-label text-dark">Commentaire :</label>
                                                        <?php //Affichage de l'avis deja existant si il y en a un
                                                        if($userAvis != false) { ?>
                                                            <textarea id="commentaire" name="commentaire" class="form-control vresize"><?= $userAvis['avis'] ?></textarea>
                                                        <?php } else { ?>
                                                            <textarea id="commentaire" name="commentaire" class="form-control vresize" placeholder="Entrez votre commentaire"></textarea>
                                                        <?php } ?>

                                                        <label for="note" class="control-label text-dark">Note :</label>

                                                        <div id="etoiles"></div>
                                                        <input type="hidden" name="note" id="noteInput" value="0">

                                                        <input  id="valNow" type="hidden" name="noteNow" class="text-muted" value="<?= $userAvis['note'] ?>">
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

                <?php } foreach($tousAvis as $avis) {
                    include("include/affichageAvis.php");
                } ?>
            </div>
        </div>
    </div>
</div>

<!-- Affichage de la fenetre modale du signalement -->
<div class="modal fade" id="signalModal">
    <div class="modal-dialog">
        <form method="post" id="formSignal" action="/report-advice">
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
                        <button type="submit" id="btnSignal" class="btn btn-success">Signaler l'avis</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
