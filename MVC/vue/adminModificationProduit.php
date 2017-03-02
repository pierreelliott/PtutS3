<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Modifier un produit</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="/administration-modification" id="modifProduit" accept-charset="utf-8" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="numProduit" id="numProduitModif" value="">
				<div class="row">
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-12">
								<div class="file-upload btn btn-primary">
									<label for="imageProduitModif" class="control-label">Parcourir...</label>
									<input type="file" id="imageProduitModif" name="image" class="upload">
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
									<label for="libelleProduitModif" class="control-label">Libellé :</label>
									<input type="text" id="libelleProduitModif" name="libelle" placeholder="Libellé" class="form-control" autofocus required>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="typeProduitModif" class="control-label">Type de produit :</label>
									<select id="typeProduitModif" name="typeProduit" class="form-control" required>
										<?php foreach($typesProduit as $typeProduit)
										{
											if(explode('.', $typeProduit)[0] != 'Menu')
											{
												echo '<option value="'.$typeProduit.'">'.$typeProduit.'</option>';
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label for="prixProduitModif" class="control-label">Prix :</label>
									<input type="number" id="prixProduitModif" name="prix" min="1" step="0.01" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="descriptionProduitModif" class="control-label">Description :</label>
							<textarea type="textarea" name="description" id="descriptionProduitModif" placeholder="Ecrivez une courte decription du produit" class="form-control vresize" required></textarea>
						</div>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="modifProduit" class="btn btn-primary">Modifier le produit</button>
	</div>
</div>
