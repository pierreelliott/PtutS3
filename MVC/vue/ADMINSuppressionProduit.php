<?php

	$title = "Administration - Supprimer produit";
	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<form method="post" action="administration.php?action=suppression" name="ajoutProduit" accept-charset="utf-8">
				<fieldset>
					<legend>Supprimer un produit</legend>
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
					<div class="row">
						<div class="col-lg-offset-4 col-lg-4">
							<button type="submit" class="btn btn-danger">Confirmer la suppression</button>
						</div>
					</div>
				</fieldset>
			</form>

		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
