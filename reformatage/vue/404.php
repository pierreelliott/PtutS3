<?php

	$title = "Erreur - Page 404";

	ob_start();
?>

	<div class='row'>
		<div class='col-lg-offset-3 col-lg-6 site-wrapper'>
			<p class='jumbotron'>Erreur 404 : la page n'a pas été trouvée ou n'existe pas</p>
		</div>
	</div>

<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
