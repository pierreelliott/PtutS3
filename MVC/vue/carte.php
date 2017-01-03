<?php
    $title = "La carte";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<table class="table table-hover">
				<tr>
					<th>Produit</th>
					<th>Description</th>
					<th>Image</th>
					<th>Ajout panier</th>
				</tr>
				<?php
					foreach($tabRows as $key => $row) {
				?>
				<tr>
					<td><a href="index.php?page=produit&produit=<?php echo $row["numProduit"]; ?>">
						<?php echo $row["libelle"]; ?></a></td>
					<td><?php echo $row["description"]; ?></td>
					<td><img src='<?php echo $row["sourceMoyen"]; ?>' alt='Image du produit'></td>
					<td>
						<button type="button" data-action="ajout" data-produit="<?php echo implode(',', $row); ?>" class="btn btn-primary">
							<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
						</button>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>
<!-- ======== Début Code Javascript ======== -->
<script>
    $(function()
    {
        $('button').click(function(e) {
            console.log('test');
            var produit = $(this).data('produit');
            var action = $(this).data('action');
						var qte = $(this).data('qte');
            $.post('index.php?page=panier',
            {
								action: action,
                produit: produit,
								qte: qte
            },
            function(data, status)
            {
                // Faire une popup pour indiquer que le produit à bien été ajouté
                location.reload(true);
                console.log('Data : ' + data + ', Status : ' + status);
            });
        });
    });
</script>
<!-- ======== Fin Code Javascript ======== -->
<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
