<?php
    include_once('modele/ProduitManager.php');
	
	function carte()
    {
		$carte = new ProduitModel();
		
		$resultat = $carte->recupererCarte();
		$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}

    include_once('vue/carte.php');
?>