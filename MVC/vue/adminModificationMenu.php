<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Ajouter un Menu</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="administration-modification" id="modifMenu" accept-charset="utf-8" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="numProduit" id="numMenuModif" value="">
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="file-upload btn btn-primary">
									<label for="imageMenuModif" class="control-label">Parcourir...</label>
									<input type="file" id="imageMenuModif" name="image" class="upload">
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
									<label for="libelleMenuModif" class="control-label">Libellé :</label>
									<input type="text" id="libelleMenuModif" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeMenuModif" class="control-label">Type de produit :</label>
									<input type="text" id="typeMenuModif" name="typeProduit" class="form-control" required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixMenuModif" class="control-label">Prix :</label>
									<input type="number" id="prixMenuModif" name="prix" min="1" step="0.01" value="0" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionMenuModif" class="control-label">Description :</label>
							<textarea type="textarea" name="description" id="descriptionMenuModif" placeholder="Ecrivez une courte decription du menu" class="form-control vresize" required></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<input type="hidden" id="lastNumProduitModif" name="lastNumProduit" value="0">
					<div id="produitsModif">

					</div>
					<div class="col-lg-1">
						<span data-toggle="tooltip" data-placement="top" title="Ajouter un produit">
							<button type="button" id="modifProduitMenu" class="glyphicon glyphicon-plus btn btn-success btn-admin"></button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="modifMenu" class="btn btn-primary">Modifier le menu</button>
	</div>
</div>
