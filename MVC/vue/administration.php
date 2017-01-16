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
              <table class="table table-striped table-hover">
        				<thead>
        					<tr>
        						<th>Produit</th>
        						<th>Description</th>
        						<th>Image</th>
        					</tr>
        				</thead>
        				<?php
        					foreach($tabRows as $produit) {
        				?>
        				<tr>
        					<td><?php echo $produit["libelle"]; ?></td>
        					<td><?php echo $produit["description"]; ?></td>
        					<td><img src='<?php echo $produit["sourceMoyen"]; ?>' alt='Image du produit'></td>
        				</tr>
        				<?php
        				}
        				?>
        			</table>
            </div>
            <div class="tab-pane" id="menus">
              <!-- Je sais pas commment sont gérés les menus donc voilà je mets ça en attendant -->
              <?php
          			for($i = 1; $i <= 4; $i++)
          			{
          			?>
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
          								<button type="button" data-action="ajout" data-produit="<?php echo $produit["numProduit"]; ?>" class="btn btn-primary">
          									<img title='Ajouter au panier' alt='Ajouter au panier' src='images/achat2.png'>
          								</button>
          							</div>
          						</div>
          					</div>
          				</div>
          			<?php
          			}
          			?>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
            <button type="button" class="btn btn-success btn-lg btn-block btn-admin">Ajout un produit</button>
            <button type="button" class="btn btn-primary btn-lg btn-block btn-admin">Modifier un produit</button>
            <button type="button" class="btn btn-danger btn-lg btn-block btn-admin">Supprimer un produit</button>
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

    });
</script>
<!-- ======== Fin Code Javascript ======== -->
<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
