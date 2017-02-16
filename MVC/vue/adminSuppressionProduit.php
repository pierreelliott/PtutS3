<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Supprimer un produit</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="/administration-suppression" id="supprProduit" accept-charset="utf-8">
			<fieldset>
				<input type="hidden" id="numProduitSuppr" name="numProduit" value="">
				<input type="hidden" id="libelleSuppr" name="libelle">
				<input type="hidden" id="typeProduitSuppr" name="typeProduit">
				<input type="hidden" id="prixSuppr" name="prix">
				<input type="hidden" id="descriptionSuppr" name="description">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>Libellé</th>
							<th>Description</th>
							<th>Image</th>
							<th>Prix</th>
							<th>Type de produit</th>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="supprProduit" class="btn btn-danger">Confirmer la suppression</button>
	</div>
</div>
