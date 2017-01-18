<?php
    include_once('modele/ProduitManager.php');

    class carteControleur
    {
		public function __construct()
		{
          $this->bdd = new ProduitManager();
		}

		public function carte()
		{
			$carte = $this->bdd->recupererCarte();
			
			$this->bdd->getTypeProduit($carte[0]["numProduit"]);
			
			
			include_once('vue/carte.php');
		}
    }
?>
