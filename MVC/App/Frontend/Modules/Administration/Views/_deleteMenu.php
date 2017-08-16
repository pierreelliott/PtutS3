<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		<h4 class="modal-title">Supprimer un menu</h4>
	</div>
	<div class="modal-body">
		<form method="post" action="/administration-delete" id="supprMenu" accept-charset="utf-8">
			<fieldset>
				<input type="hidden" id="numMenuSuppr" name="numProduit" value="">
				<input type="hidden" id="libelleMenuSuppr" name="libelle">
				<input type="hidden" id="typeMenuSuppr" name="typeProduit">
				<input type="hidden" id="prixMenuSuppr" name="prix">
				<input type="hidden" id="descriptionMenuSuppr" name="description">

				<div class="panel panel-default panel-menu">
					<div class="panel-header">
						<div class="row">
							<h2 class="menu-heading"></h2>
						</div>
						<div class="row">
							<div class="col-sm-offset-1 col-lg-7 col-md-7 col-sm-7">
								<p class="desc-frame text-left"></p>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p class="price-frame text-center"></p>
							</div>
						</div>
					</div>
					<div class="panel-body row"></div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		<button type="submit" form="supprMenu" class="btn btn-danger">Confirmer la suppression</button>
	</div>
</div>
