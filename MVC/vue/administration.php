<?php
    $title = "La carte";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->
  <!-- Popup d'information succès ajout produit -->
  <div class="alert alert-success hidden">
    Produit correctement ajouté !
  </div>
  <!-- fin popup -->
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
      <div class="row">
        <div class="col-xs-6">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
            <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="produits">
              <ul class="nav nav-pills">
        				<?php
        					foreach($produits as $key => $produit) {
        				?>
                <li<?php echo ($key == 0) ? ' class="active"' : ''; ?>><a href="#" data-toggle="tab" data-numProduit="<?php echo $produit["numProduit"]; ?>">
          				<div class="panel panel-default">
          					<div class="media">
          						<div class="media-left media-top">
          							<img src="<?php echo $produit["sourceMoyen"]; ?>" class="media-object" style="width:80px">
          						</div>
          						<div class="media-body">
          							<h2 class="media-heading text-muted"><?php echo $produit["libelle"]; ?></h2>
          							<p class="text-muted pull-left"><?php echo $produit["description"]; ?></p>
          							<p class="text-muted">Prix : <?php echo $produit["prix"]; ?>€</p>
          						</div>
          					</div>
          					<div class="panel-footer">
          						<div class="row">
          							<div class="col-lg-offset-8 col-lg-4">
          								<!--<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-primary">
          									<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
          								</button>-->
          							</div>
          						</div>
          					</div>
          				</div>
                </a></li>
        				<?php
        				}
        				?>
        			</ul>
            </div>
            <div class="tab-pane" id="menus">
              <!-- Je sais pas commment sont gérés les menus donc voilà je mets ça en attendant -->
              <ul class="nav nav-pills">
              <?php
          			for($i = 1; $i <= 4; $i++)
          			{
          			?>

                <li<?php echo ($i == 1) ? ' class="active"' : ''; ?>><a href="#" data-toggle="tab">
          				<div class="panel panel-default">
          					<div class="media">
          						<div class="media-left media-top">
          							<img src="images/maki1,1.png" class="media-object" style="width:80px">
          						</div>
          						<div class="media-body">
          							<h2 class="media-heading text-muted">Menu <?php echo $i;?></h2>
          							<p class="text-muted pull-left">Description [...........]</p>
          							<p class="text-muted">Prix : 2€</p>
          						</div>
          					</div>
          					<div class="panel-footer">
          						<div class="row">
          							<div class="col-lg-offset-8 col-lg-4">
          								<!--<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-primary">
          									<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
          								</button>-->
          							</div>
          						</div>
          					</div>
          				</div>
                </a></li>
          			<?php
          			}
          			?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <button type="button" class="btn btn-success btn-lg btn-block btn-admin" data-toggle="modal" data-target="#adminAjout">Ajouter un produit</button>
          <button type="button" class="btn btn-primary btn-lg btn-block btn-admin modifProduit" data-toggle="modal" data-target="#adminModif">Modifier un produit</button>
          <button type="button" class="btn btn-danger btn-lg btn-block btn-admin supprProduit" data-toggle="modal" data-target="#adminSuppr">Supprimer un produit</button>
        </div>
      </div>
		</div>
	</div>

  <!-- Début fenête modales -->
  <div class="modal fade" id="adminAjout">
    <div class="modal-dialog">
      <?php include("vue/ADMINAjoutProduit.php"); ?>
    </div>
  </div>

  <div class="modal fade" id="adminModif">
    <div class="modal-dialog">
      <?php include("vue/ADMINModificationProduit.php"); ?>
    </div>
  </div>

  <div class="modal fade" id="adminSuppr">
    <div class="modal-dialog">
      <?php include("vue/ADMINSuppressionProduit.php"); ?>
    </div>
  </div>
  <!-- Fin fenêtres modales -->

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>
<!-- ======== Début Code Javascript ======== -->
<script>
    $(function()
    {
      // Lorsqu'on choisi une image dans l'input file
      $('#imageAjout, #imageModif').change(function (e1) {
        var filename = e1.target.files[0];
        var fr = new FileReader();
        fr.onload = function (e2) {
          $('.apercuImage').attr('src', e2.target.result);
        };
        fr.readAsDataURL(filename);
      });

      $('#adminAjout, #adminModif').on('hidden.bs.modal', function(e)
      {
        $(this).find('input, textarea').val('');
        $('.apercuImage').attr('src', '');
      });
	  
	  $('.modifProduit').click(function(e)
	  {
		var numProduit = $('.tab-pane.active li.active').find('a').data('numproduit');
		
		$.post("index.php?page=getProduitAdmmin",
		{
			numProduitAdmin: numProduit
		},
		function(data, status)
		{
			produit = JSON.parse(data);
			
			$('#numProduitModif').val(produit.numProduit);
			$('.apercuImage').attr('src', produit.sourceMoyen);
			$('#libelleModif').val(produit.libelle);
			$('#typeProduitModif').val(produit.typeProduit);
			$('#prixModif').val(produit.prix);
			$('#descriptionModif').val(produit.description);
		});
	  });
	  
	  $('.supprProduit').click(function(e)
	  {
		var numProduit = $('.tab-pane.active li.active').find('a').data('numproduit');
		
		$('tbody').html(
			'<tr>' +
			'\t<th>Libellé</th>' +
			'\t<th>Description</th>' +
			'\t<th>Image</th>' +
			'\t<th>Prix</th>' +
			'\t<th>Type de produit</th>' +
			'</tr>'
		);
		
		$.post("index.php?page=getProduitAdmmin",
		{
			numProduitAdmin: numProduit
		},
		function(data, status)
		{
			produit = JSON.parse(data);
			
			$('#numProduitSuppr').val(produit.numProduit);
			$('tbody').append(
				'<tr>\n' +
				'\t<td>' + produit.libelle + '</td>' +
				'\t<td>' + produit.description + '</td>' +
				'\t<td><img src="' + produit.sourceMoyen + '" alt="image" class="img-responsive"></td>' +
				'\t<td>' + produit.prix + '</td>' +
				'\t<td>' + produit.typeProduit + '</td>' +
				'</tr>'
			);
		});
	  });
    });
</script>
<!-- ======== Fin Code Javascript ======== -->
<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
