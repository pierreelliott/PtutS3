<?php

	$title = "Mon compte";

	ob_start();
?>

	<div class="row">
		<div class="col-lg-offset-3 col-lg-6 site-wrapper">
			<h1>Vos informations - <?php echo $nom.' '.$prenom; ?></h1>
			<dl class="dl-horizontal">
				<dt><span class="glyphicon glyphicon-user"></span> Pseudo :</dt>
				<dd><?php echo $pseudo; ?></dd>
				<dt>@ Adresse mail :</dt>
				<dd><?php echo $mail; ?></dd>
				<dt><span class="glyphicon glyphicon glyphicon-phone"></span> Téléphone :</dt>
				<dd><?php echo $telephone; ?></dd>
				<dt><span class="glyphicon glyphicon-map-marker"></span> Adresse :</dt>
				<dd>
					<?php
						if(isset($numRue) and
						isset($rue) and
						isset($codePostal) and
						isset($ville))
						{
							echo
							$numRue.' '.
							$rue.'<br>'.
							$codePostal.' '.
							$ville;
						}
						else echo "Vous n'avez pas renseigné d'adresse";
						
					?>
				</dd>
				<dt><span class="glyphicon glyphicon-map-marker"></span> Date d'inscription :</dt>
				<dd><?php echo $dateInscription; ?></dd>
			</dl>
		</div>
	</div>

<?php
	$contenu = ob_get_clean();

	require("layout/site.php");
?>
