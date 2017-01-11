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
		      $tabRows = $this->bdd->recupererCarte();
          include_once('vue/carte.php');
      }
    }
?>
