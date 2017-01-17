<?php
    include_once('modele/ProduitManager.php');

    class AdminControleur
    {
  		public function __construct()
      {
          $this->bdd = new ProduitManager();
      }

      public function administrer()
      {
		      $tabRows = $this->bdd->recupererCarte();
          include_once('vue/administration.php');
      }
    }
?>
