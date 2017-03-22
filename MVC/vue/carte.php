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
		<div class="col-md-offset-2 col-md-8 site-wrapper">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#produits" data-toggle="tab">Nos produits</a></li>
        <li><a href="#menus" data-toggle="tab">Nos menus</a></li>
      </ul>
      <div class="tab-content">
		<!-- Affichage des produits seuls -->
        <div class="tab-pane fade in active push" id="produits">
			<hr class="invisible-separator"/>
			<?php
				foreach($carte as $produit)
				{
					include("include/affichageProduit.php");
				}
			?>

          	<div class="modal fade" id="produitModal">
	            <div class="modal-dialog">
	              	<div class="modal-content">
		                <div class="modal-header">
		                  	<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
		                  	<h4 class="modal-title">Produit</h4>
		                </div>
		                <div class="modal-body">
		                  	<div class="row">
			                    <div class="col-sm-4">
			                      	<img src="images/sushi.png" alt="Image du produit" id="imgModal" class="img-responsive">
			                    </div>
			                    <div class="col-sm-8">
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
		<!-- Affichage des menus -->
        <div class="tab-pane fade" id="menus">
			<hr class="invisible-separator"/>
          	<?php
		  		foreach($menus as $menu)
				{
					include("include/affichageMenu.php");
				}
			?>
        </div>
      </div>
	</div>
</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	  $contenu = ob_get_clean();
?>

<script src="js/carte.js?v=<?php echo filemtime('css/style.css'); ?>"></script>

<?php
    $script = ob_get_clean();

    require("layout/site.php");
?>
