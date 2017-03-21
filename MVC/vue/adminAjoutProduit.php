<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Ajouter un produit</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="administration-ajout" id="ajoutProduit" accept-charset="utf-8" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="numProduit" id="numProduitAjout" value="">
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="file-upload btn btn-primary">
									<label for="imageProduitAjout" class="control-label">Parcourir...</label>
									<input type="file" id="imageProduitAjout" name="image" class="upload">
								</div>
							</div>
							<div class="col-lg-12">
								<img class="apercuImage img-responsive">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label for="libelleProduitAjout" class="control-label">Libellé :</label>
									<input type="text" id="libelleProduitAjout" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeProduitAjout" class="control-label">Type de produit :</label>
									<select id="typeProduitAjout" name="typeProduit" class="form-control" required>
										<?php foreach($typesProduit as $typeProduit)
										{
											echo '<option value="'.$typeProduit.'">'.$typeProduit.'</option>';
										} ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixProduitAjout" class="control-label">Prix :</label>
									<input type="number" id="prixProduitAjout" name="prix" min="1" step="0.01" value="0" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionProduitAjout" class="control-label">Description :</label>
							<textarea  name="description" id="descriptionProduitAjout" placeholder="Ecrivez une courte decription du produit" class="form-control vresize" required></textarea>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="ajoutProduit" class="btn btn-success">Ajouter à la base de données <span class="glyphicon glyphicon-ok"></span></button>
	</div>
</div>
