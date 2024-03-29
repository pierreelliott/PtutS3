<?php
    include_once('modele/ProduitManager.php');
	include_once('modele/UserManager.php');

    class carteControleur
    {
		public function __construct()
		{
          $this->bdd = new ProduitManager();
		  $this->um = new UserManager();
		}

		public function carte()
		{
			$carte = $this->bdd->recupererCarte();

			if(isset($_SESSION["utilisateur"]["pseudo"]))
			{
				foreach($carte as $keyProduit => $produit)
				{
					$produit["favori"] = $this->um->estFavoris($_SESSION["utilisateur"]["pseudo"],$produit["numProduit"]);
					$carte[$keyProduit] = $produit;
				}
			}


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

				// Pour permettre l'affiche des caractères comme '\n' en balise <br> (ça cause des problèmes donc je met ça en commmentaire en attendant)
				//$carte[$keyMenu]["description"] = nl2br($carte[$keyMenu]["description"]);

				$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);

				//Test pour savoir ce que contiennent les variables
				//$test[$keyMenu] = array("type" => $typeProduit, "libelle" => $carte[$keyMenu]["libelle"]);

				// On teste le type du produit pour savoir si c'est un menu
				if(strcmp($typeProduit, "menu") == 0)
				{
					// Si le produit est un menu, on l'enlève de la carte
					unset($carte[$keyMenu]);

					// On récupère les informations du menu (libellé, description, prix)
					$menus[$keyMenu] = $this->bdd->getInformationsProduit($produit["numProduit"]);

					// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
					$produitCompatibles = $this->bdd->getProduitsCompatibles($produit["numProduit"]); // C'est un tableau des numProduits2

					// Pour chaque numProduit compatible, on récupère les informations du produit
					foreach($produitCompatibles as $keyProduit => $produitCompatible)
					{
						$menus[$keyMenu]["produits"][$keyProduit] = $this->bdd->getInformationsProduit($produitCompatible["numProduit2"]);
						// Pour permettre l'affiche des caractères comme '\n' en balise <br> (ça cause des problèmes donc je met ça en commmentaire en attendant)
						//$menus[$keyMenu]["produits"][$keyProduit]["description"] = nl2br($menus[$keyMenu]["produits"][$keyProduit]["description"]);
					}
				}
				// La variable $menus est de la forme
				/*	menus	[$numMenu1]	["libelle"]
										["description"]
										["prix"]
										["produits"]	[$numProduit1]	["libelle"]
																		["description"]
														[$numProduit2]	["libelle"]
																		["description"]
							[$numMenu2]	(...)
				*/
			}

			include_once('vue/carte.php');
		}
    }
?>
