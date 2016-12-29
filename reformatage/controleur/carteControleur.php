<?php
    include_once('modele/ProduitManager.php');

    //session_start();
	
	class carteControleur
	{
		public function carte()
		{
			$bdd = new ProduitModel();

			$resultat = $bdd->recupererCarte();
			$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);
			
			include_once('vue/carte.php');
		}
	}
?>
