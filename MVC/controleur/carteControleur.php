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
				// Si le prix est négatif, on ne l'affichera pas
				// (peu importe que que ce soit un produit seul ou un menu)
				if($produit["prix"] < 0)
				{
					unset($carte[$keyMenu]);
					continue;
				}


				$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);

				//Test pour savoir ce que contiennent les variables
				//$test[$keyMenu] = array("type" => $typeProduit, "libelle" => $carte[$keyMenu]["libelle"]);

				if(strcmp($typeProduit, "menu") == 0)
				{
					unset($carte[$keyMenu]);
					$menus[$keyMenu] = $this->bdd->getInformationsProduit($produit["numProduit"]);
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
