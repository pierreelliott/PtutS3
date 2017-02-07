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
								<div class="form-group">
									<span class="glyphicon glyphicon-shopping-cart"></span>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="file-upload btn btn-primary">
									<label for="imageAjout" class="control-label">Parcourir...</label>
									<input type="file" id="imageAjout" name="image" class="upload">
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
									<label for="libelleAjout" class="control-label">Libellé :</label>
									<input type="text" id="libelleAjout" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeProduitAjout" class="control-label">Type de produit :</label>
									<select id="typeProduitAjout" name="typeProduit" class="form-control" required>
										<option value="Sushi">Sushi</option>
										<option value="Maki">Maki</option>
										<option value="Sauce">Sauce</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixAjout" class="control-label">Prix :</label>
									<input type="number" id="prixAjout" name="prix" min="1" step="0.01" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionAjout" class="control-label">Description :</label>
							<textarea type="textarea" name="description" id="descriptionAjout" placeholder="Ecrivez une courte decription du produit" class="form-control" required></textarea>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" form="ajoutProduit" class="btn btn-success">Ajouter à la base de données <span class="glyphicon glyphicon-ok"></span></button>
	</div>
</div>
