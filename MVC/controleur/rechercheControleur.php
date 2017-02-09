<?php
    include_once('modele/ProduitManager.php');

    class RechercheControleur
    {
  		public function __construct()
		{
			$this->bdd = new ProduitManager();
		}

		public function rechercher()
		{
			if(isset($_POST["nomProduitRecherche"]))
			{
				$produits = $this->bdd->rechercherProduits($_POST["nomProduitRecherche"]);

				$rechercheVide = empty($produits);

				//$menus = array();
				foreach($produits as $key => $produit)
				{
					if($produit["prix"] < 0)
					{
						unset($carte[$key]);
						continue;
					}

					/*$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);
					if($typeProduit == "menu")
					{
						$menus[$keyMenu] = getInformationsProduit($produit["numProduit"]);
						$produitCompatibles = $this->bdd->getProduitsCompatibles($produit["numProduit"]);
						foreach($produitCompatibles as $keyProduit => $produitCompatible)
						{
							$menus[$keyMenu]["produits"][$keyProduit] = $this->bdd->getInformationsProduit($produitCompatible["numProduit2"]);
						}
					}*/
				}

				include_once('vue/recherche.php');
			}
		}
    }
?>
