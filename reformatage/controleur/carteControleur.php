<?php
    include_once('modele/carte/CarteModel.php');
    
    session_start();
	
	function carte()
    {
		$carte = new ProduitModel();
		
		$resultat = $carte->recupererCarte();
		$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);
	}

    include_once('vue/carte/index.php');
?>