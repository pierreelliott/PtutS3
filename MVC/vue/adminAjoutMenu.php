<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Ajouter un Menu</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="administration-ajout" id="ajoutMenu" accept-charset="utf-8" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="numProduit" id="numMenuAjout" value="">
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="file-upload btn btn-primary">
									<label for="imageMenuAjout" class="control-label">Parcourir...</label>
									<input type="file" id="imageMenuAjout" name="image" class="upload">
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
									<label for="libelleMenuAjout" class="control-label">Libellé :</label>
									<input type="text" id="libelleMenuAjout" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeMenuAjout" class="control-label">Type de produit :</label>
									<input type="text" id="typeMenuAjout" name="typeProduit" class="form-control" required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixMenuAjout" class="control-label">Prix :</label>
									<input type="number" id="prixMenuAjout" name="prix" min="1" step="0.01" value="0" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionMenuAjout" class="control-label">Description :</label>
							<textarea  name="description" id="descriptionMenuAjout" placeholder="Ecrivez une courte decription du menu" class="form-control vresize" required></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" id="lastNumProduitAjout" name="lastNumProduit" value="0">
					<div id="produitsAjout">

					</div>
					<div class="col-lg-1">
						<span data-toggle="tooltip" data-placement="top" title="Ajouter un produit">
							<button type="button" id="ajoutProduitMenu" class="glyphicon glyphicon-plus btn btn-success btn-admin"></button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="ajoutMenu" class="btn btn-success">Ajouter à la base de données <span class="glyphicon glyphicon-ok"></span></button>
	</div>
</div>
