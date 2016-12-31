<?php
    include_once('modele/ProduitManager.php');
	
    class carteControleur
    {
		public function __construct()
        {
            $this->bdd = new ProduitModel();
        }
		
        public function carte()
        {
            $resultat = $this->bdd->recupererCarte();
            $tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);

            include_once('vue/carte.php');
        }
    }
?>