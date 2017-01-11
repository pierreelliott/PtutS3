<?php
    include_once('modele/CommandeManager.php');

    class commandeControleur
    {
		public function __construct()
		{
			$this->bdd = new CommandeManager();
		}

		public function afficherHistorique($pseudo)
		{
			$commandes = $this->bdd->getHistoriqueCommande($pseudo);

			include_once('vue/historiqueCommandes.php');
		}

		public function afficherCommande($numCommande)
		{
			$resultat = $this->bdd->getInfosCommande($numCommande);

			$dateCommande = $resultat["date"];
			$prixCommande = $this->bdd->getPrixTotalCommande($numCommande);

			if(true) //Si la commande n'existe pas => comment faire ?
			{
                //Pour chaque produit dans la commande
				foreach($resultat => $prod)
				{
					$p = $this->bdd->getInfosProduit($prod["numProduit"]);
					$produit = array(
						"numProduit" => $p["numProduit"];
						"libelle" => $p["libelle"],
						"description" => $p["description"],
						"quantite" => $prod["quantite"],
						"prix" => $p["prix"],
						"prixTotal" => $p["prix"]* $prod["quantite"],
						"sourcePetit" => $p["sourcePetit"],
						"sourceMoyen" => $p["sourceMoyen"],
						"sourceGrand" => $p["sourceGrand"]
					);

					$produits[$numProduit] = $produit;
				}

				include_once("vue/commande.php");
			}
			else
			{
					include_once("vue/404.php");
			}
		}
    }
?>
