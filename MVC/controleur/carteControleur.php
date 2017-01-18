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
			
			$menus = array();
			foreach($carte as $keyMenu => $produit)
			{
				$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);
				if($typeProduit == "menu")
				{
					$menus[$keyMenu] = getInformationsProduit($produit["numProduit"]);
					$produitCompatibles = $this->bdd->getProduitsCompatibles($produit["numProduit"]);
					foreach($produitCompatibles as $keyProduit => $produitCompatible)
					{
						$menus[$keyMenu]["produits"][$keyProduit] = $this->bdd->getInformationsProduit($produitCompatible["numProduit2"]);
					}
				}
			}
			
			include_once('vue/carte.php');
		}
    }
?>
