<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Supprimer un produit</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="/administration-suppression" id="supprProduit" accept-charset="utf-8">
			<fieldset>
				<input type="hidden" id="numProduitSuppr" name="numProduit" value="">
				<input type="hidden" id="libelleProduitSuppr" name="libelle">
				<input type="hidden" id="typeProduitSuppr" name="typeProduit">
				<input type="hidden" id="prixProduitSuppr" name="prix">
				<input type="hidden" id="descriptionProduitSuppr" name="description">

				<div class="media img-produit">
					<div class="media-top">
						<img src="" alt="" class="media-object img-thumbnail center-block">
					</div>
					<div class="media-body">
						<h2 class="media-heading text-center push-down"></h2>
						<div class="desc-frame"><p class="text-left"></p></div>
						<p class="price-frame"></p>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="supprProduit" class="btn btn-danger">Confirmer la suppression</button>
	</div>
</div>
