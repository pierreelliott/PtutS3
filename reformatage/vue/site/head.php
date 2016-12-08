<?php

	function afficherHead($titre)
	{
		echo '<!DOCTYPE html>
		<html lang="fr">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
				<meta name="description" content="sushis en ligne restauration rapide emporter livraison">
				<meta name="author" content="PIETRAC Nicolas - Mathis SLIMANI - PE Thiboud - Axel BERTRAND - Thomas BROUBROU">
				<link rel="icon" href="images/logo_onglet.png">';

        if(isset($titre))
		{
			echo '<title>'.$titre.'</title>';
		}
		else
		{
			echo '<title>Sushinos - Sushis en ligne</title>';
		}
		
		include("bootstrapCss.php");

        echo '</head>';
	}

?>