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
		      $tabRows = $this->bdd->recupererCarte();
          include_once('vue/carte.php');
      }

  		public function afficherProduit($numProduit)
  		{
  			$resultat = $this->bdd->getInformationsProduit($numProduit);

  			if(true) //Si le produit n'existe pas => comment faire ?
  			{
  				$libelle = $resultat["libelle"];
  				$description = $resultat["description"];
  				$prix = $resultat["prix"];
  				$sourcePetit = $resultat["sourcePetit"];
  				$sourceMoyen = $resultat["sourceMoyen"];
  				$sourceGrand = $resultat["sourceGrand"];

  				include_once("vue/produit.php");
  			}
  			else
        {
  				include_once("vue/404.php");
        }
  		}
    }
?>
