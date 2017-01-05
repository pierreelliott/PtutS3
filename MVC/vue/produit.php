<?php
    $title = $libelle;

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<a href="javascript:go('carte')" class="btn btn-md btn-default btn-info">Retour à la carte</a>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-default" style="color:black">
						<div class="panel-heading">
							<h1><?php echo $libelle;?></h1>
						</div>
						<div class="panel-body">
							<div class="media">
								<div class="media-left">
									<img src='<?php echo $sourceGrand/*'images/aa.png'*/; ?>' alt='Image du produit "<?php echo $libelle;?>"'>
								</div>
								<div class="media-body">
									<p class="lead">
										<?php echo $description;?>
									</p>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div>
								<h1>Prix : <?php echo $prix;?> €</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

    require("layout/site.php");
?>
