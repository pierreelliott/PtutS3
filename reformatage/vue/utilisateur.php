<?php

	$title = "Mon compte";

	ob_start();
?>

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<h1><?php echo $_SESSION["utilisateur"]["nom"].' '.$_SESSION["utilisateur"]["prenom"]; ?></h1>
			<dl class="dl-horizontal">
				<dt><span class="glyphicon glyphicon-user"></span> Pseudo :</dt>
				<dd><?php echo $_SESSION["utilisateur"]["pseudo"]; ?></dd>
				<dt>@ Adresse mail :</dt>
				<dd><?php echo $_SESSION["utilisateur"]["mail"]; ?></dd>
				<dt><span class="glyphicon glyphicon glyphicon-phone"></span> T�l�phone :</dt>
				<dd><?php $_SESSION["utilisateur"]["telephone"]; ?></dd>
				<dt><span class="glyphicon glyphicon-map-marker"></span> Adresse :</dt>
				<dd>
					<?php echo
						$_SESSION["utilisateur"]["numRue"].' '.
						$_SESSION["utilisateur"]["rue"].'<br>'.
						$_SESSION["utilisateur"]["codePostal"].' '.
						$_SESSION["utilisateur"]["ville"];
					?>
				</dd>
			</dl>
		</div>
	</div>

<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
