<?php
    include_once('modele/carteModel.php');

    session_start();

	function carte()
    {
		$bdd = new CarteModel();

		$resultat = $bdd->recupererCarte();
		$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}

    include_once('vue/carte.php');
?>
