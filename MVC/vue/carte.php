<?php
    $title = "La carte";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
        <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="produits">
          <table class="table table-striped table-hover">
    				<thead>
    					<tr>
    						<th>Produit</th>
    						<th>Description</th>
    						<th>Image</th>
    						<th>Ajout panier</th>
    					</tr>
    				</thead>
    				<?php
    					foreach($tabRows as $numProduit => $produit) {
    				?>
    				<tr>
    					<td>
                <a href="#produitModal" data-toggle="modal"
                                        data-numProduit="<?php echo $produit["numProduit"]; ?>"
                                        data-libelle="<?php echo $produit["libelle"]; ?>"
                                        data-sourceImg="<?php echo $produit['sourceMoyen']; ?>"
                                        data-description="<?php echo $produit["description"]; ?>"
                                        data-prix="<?php echo $produit["prix"]; ?>">
					        <?php echo $produit["libelle"]; ?>
                </a>
              </td>
    					<td><?php echo $produit["description"]; ?></td>
    					<td><img src='<?php echo $produit["sourceMoyen"]; ?>' alt='Image du produit'></td>
    					<td>
    						<button type="button" data-action="ajout" data-produit="<?php echo $numProduit; ?>" class="btn btn-primary">
    							<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
    						</button>
    					</td>
    				</tr>
    				<?php
    				}
    				?>
    			</table>
          <div class="modal fade" id="produitModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-4">
                      <img src="images/sushi.png" alt="Image du produit" id="imgModal" class="img-responsive">
                    </div>
                    <div class="col-xs-8">
                      <p id="descriptionProduit"></p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <p id="prixProduit" class="text-center"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="menus">
          <!-- Je sais pas commment sont gérés les menus donc voilà je mets ça en attendant -->
          <table class="table table-striped table-hover">
    				<thead>
    					<tr>
    						<th>Produit</th>
    						<th>Description</th>
    						<th>Image</th>
    						<th>Ajout panier</th>
    					</tr>
    				</thead>
    				<tr><td>Test</td></tr>
    			</table>
        </div>
      </div>

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
            $.post('index.php',
            {
                page: 'panier',
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

        $('#produitModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var numProduit = button.data('numProduit');
          var libelle = button.data('libelle');
          var sourceImg = button.data('sourceImg');
          var description = button.data('description');
          var prix = button.data('prix');
          var modal = $(this);
          modal.find('.modal-title').text(libelle);
          modal.find('#imgModal').attr('src', sourceImg);
          modal.find('#descriptionProduit').text(description);
          modal.find('#prixProduit').text('Prix : ' + prix + '€');
        });
    });
</script>
<!-- ======== Fin Code Javascript ======== -->
<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
