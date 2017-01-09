<?php
    $title = "Avis des utilisateurs du site";

    ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<?php
				for($i = 1; $i <= 6; $i++)
				{
				?>
					<div class="panel panel-default">
						<div class="media">
							<div class="media-left media-top">
								<img src="images/user.png" class="media-object" style="width:80px">
							</div>
							<div class="media-body">
								<h2 class="media-heading text-muted">Utilisateur</h2>
								<p class="text-muted pull-left">Commentaire [...........]</p>
								<p class="text-muted">Note : * * * * *</p>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
<!-- ======== Fin Code HTML ======== -->
<?php

	$contenu = ob_get_clean();
	
	require("layout/site.php");
?>