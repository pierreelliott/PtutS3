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
			$resultat = $this->bdd->afficherCommande($numCommande);
			
			$dateCommande = $resultat["date"];
			$prixCommande = $resultat["prix"];

			if(true) //Si la commande n'existe pas => comment faire ?
			{
				foreach($resultat["numProduit"] => $numProduit)
				{
					$p = $this->bdd->getInfosProduit($numProduit);
					$produit = array(
						"numProduit" = $p["numProduit"];
						"libelle" => $p["libelle"],
						"description" => $p["description"],
						"quantite" => $qte,
						"prix" => $p["prix"],
						"prixTotal" => $p["prix"]*$qte,
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
