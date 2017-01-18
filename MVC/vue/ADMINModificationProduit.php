<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Modifier un produit</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="index.php?page=administration&action=modification" id="modifProduit" accept-charset="utf-8" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="numProduit" id="numProduitModif" value="">
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
									<label for="imageModif" class="control-label">Parcourir...</label>
									<input type="file" id="imageModif" name="image" class="upload">
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
									<label for="libelleModif" class="control-label">Libellé :</label>
									<input type="text" id="libelleModif" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeProduitModif" class="control-label">Type de produit :</label>
									<select id="typeProduitModif" name="typeProduit" class="form-control" required>
										<option value="Sushi">Sushi</option>
										<option value="Maki">Maki</option>
										<option value="Sauce">Sauce</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixModif" class="control-label">Prix :</label>
									<input type="number" id="prixModif" name="prix" min="1" step="0.01" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionModif" class="control-label">Description :</label>
							<textarea type="textarea" name="description" id="descriptionModif" placeholder="Ecrivez une courte decription du produit" class="form-control" required></textarea>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" form="" class="btn btn-success btn btn-success">Modifier le produit</button>
	</div>
</div>
