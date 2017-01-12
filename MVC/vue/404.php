<?php

	$title = "Erreur - Page 404";

	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class='row'>
		<div class='col-lg-offset-3 col-lg-6 site-wrapper'>
			<div class='jumbotron'><h1>Erreur 404 : la page n'a pas été trouvée ou n'existe pas</h1></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-4 col-md-4">
			<a href="index.php"  class="btn btn-md btn-default">Revenir à l'accueil</a>
		</div>
	</div>

<!-- ======== Fin Code HTML ======== -->
<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>