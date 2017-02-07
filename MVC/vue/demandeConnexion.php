<?php
	$title = "Connexion nécessaire";

	ob_start();
?>
<!-- ======== Début Code HTML ======== -->

	<div class="row">
        <div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<div class="col-lg-12">
				<div class="row">
					<h1 class="col-lg-offset-2 col-lg-8">Vous n'êtes pas connecté !</h1>
				</div>
				<div class="row">
					<p class="lead">Vous essayez d'accéder à une page nécessitant d'être connecté. Veuillez commencer par vous connecter.</p>
				</div>
				<div class="row">
					<div class="col-lg-offset-4 col-lg-4">
						<a href="/connexion" class="btn btn-md btn-default btn-info">Se connecter</a>
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
