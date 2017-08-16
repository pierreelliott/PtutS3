<!-- Popup d'information succès ajout produit -->
<div class="alert alert-success hidden">
	Produit correctement ajouté !
</div>
<!-- fin popup -->
<div class="row">
	<div class="col-lg-offset-2 col-lg-8 site-wrapper">
		<div class="row">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#produits" data-toggle="tab">Produits</a></li>
				<li><a href="#menus" data-toggle="tab">Menus</a></li>
                <li><a href="#avis" data-toggle="tab">Avis</a></li>
				<li><a href="#administrateurs" data-toggle="tab">Administrateurs</a></li>
				<li><a href="#paypal" data-toggle="tab">Paypal</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="produits">
					<div class="row">
						<div class="col-sm-12">
							<!-- Bouton ajouter produit -->
							<span data-toggle="tooltip" data-placement="top" title="Ajouter un produit">
								<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminProduitAjout"></button>
							</span>
						</div>
					</div>

					<?php foreach($produits as $produit) {
						include('include/affichageProduit.php');
					} ?>

				</div>
				<div class="tab-pane fade" id="menus">
					<div class="tab-pane fade in active" id="produits">
						<!-- Bouton ajouter menu -->
						<span data-toggle="tooltip" data-placement="top" title="Ajouter un menu">
							<button type="button" class="glyphicon glyphicon-plus btn btn-success btn-admin" data-toggle="modal" data-target="#adminMenuAjout"></button>
						</span>
						<?php foreach($menus as $menu) {
							include('include/affichageMenu.php');
						} ?>
					</div>
				</div>

                <!-- Onglet du tableau -->
                <div class="tab-pane fade" id="avis">
                    <?php if($tousAvis != false) {
                        include('_advices.php');
                    }
                    else {
                        echo "<p class='jumbotron'>Aucun avis n'a été signalé</p>";
                    } ?>
                </div>
				<div class="tab-pane fade" id="administrateurs">
					<?php include('_admins.php'); ?>
				</div>
				<div class="tab-pane fade" id="paypal">
					<!-- nom utilisateur api, mdp api, signature api, (version api) -->
					<hr class="invisible-separator">
					<div class="panel panel-default">
						<div class="panel-body text-muted">
							<div class="row">
								<!--
								<div class="col-sm-6">
									<div class="desc-frame">
										<legend>Paramètres actuels</legend>
										<p>Utilisateur : <span class="text-info">echo paypal["utilisateur"]</span></p>
										<p>Mot de passe : <span class="text-info">echo paypal["mdp"]</span></p>
										<p>Signature : <span class="text-info">echo paypal["signature"]</span></p>
									</div>
								</div>
								-->
								<div class="col-sm-offset-3 col-sm-6">
									<form method="post" action="/edit-paypal-params" class="form">
										<fieldset>
											<legend class="text-muted">Modifier les paramètres de paypal</legend>
											<label for="userPaypal" class="label-form">Utilisateur paypal (vendeur)</label>
											<input type="text" id="userPaypal" name="userPaypal" class="form-control">

											<label for="mdpPaypal" class="label-form">Mot de passe paypal</label>
											<input type="text" id="mdpPaypal" name="mdpPaypal" class="form-control">

											<label for="signaturePaypal" class="label-form">Signature paypal</label>
											<input type="text" id="signaturePaypal" name="signaturePaypal" class="form-control">

											<button type="submit" class="btn btn-primary">Valider les changement</button>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Début fenêtres modales -->
<!-- Fenêtre modales de supression de commentaire d'avis -->
<div class="modal fade" id="adminAvisConfirm">
    <div class="modal-dialog">
      	<?php include('_modalDeleteComment.php'); ?>
    </div>
</div>

<!-- Fenêtre modales de modif de commentaire d'avis -->
<div class="modal fade" id="adminAvisModif">
    <div class="modal-dialog">
      	<?php include('_modalEditComment.php'); ?>
    </div>
</div>

<!-- Fenêtre modales d'affichage des signalements d'avis -->
<div class="modal fade" id="adminSignalement">
    <div class="modal-dialog">
      	<?php include('_modalReport.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminProduitAjout">
    <div class="modal-dialog">
      	<?php include('_addProduct.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminMenuAjout">
    <div class="modal-dialog">
      	<?php include('_addMenu.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminProduitModif">
    <div class="modal-dialog">
      	<?php include('_editProduct.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminMenuModif">
    <div class="modal-dialog">
      	<?php include('_editMenu.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminProduitSuppr">
    <div class="modal-dialog">
      	<?php include('_deleteProduct.php'); ?>
    </div>
</div>

<div class="modal fade" id="adminMenuSuppr">
    <div class="modal-dialog modal-lg">
      	<?php include('_deleteMenu.php'); ?>
    </div>
</div>
<!-- Fin fenêtres modales -->
