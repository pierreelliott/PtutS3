<?php

	$title = "Erreur - Page 404";

	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

<div class="row">
	<div class="col-lg-offset-2 col-lg-8 site-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron"><h1>Erreur 404 : la page n'a pas été trouvée ou n'existe pas</h1></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<a href="/"  class="btn btn-block btn-success">Revenir à l'accueil</a>
			</div>
		</div>
	</div>
</div>


<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
