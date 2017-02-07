<?php
    include_once('modele/CommandeManager.php');
    include_once('modele/ProduitManager.php');

    class CommandeControleur
    {
        public $bdCommande, $bdProduit;
		public function __construct()
		{
			$this->bdCommande = new CommandeManager();
            $this->bdProduit = new ProduitManager();
		}

		public function afficherHistorique($pseudo)
		{
            /*Creation d'un tableau 2 dimension contenant
            toutes les commandes avec 2 colonnes en plus: prix et
            nbProduits
            1er dimension contient le nombre de ligne
            2ème les differentes colonne de la requete sql*/
            $commandes = array('ligne' => array('date' => 'NULL',
                            'typeCommande' => 'NULL',
                            'numCommande'  => 'NULL',
                            'prix' =>  0,
                            'nbProduits' => 0));

            //On recupere les commandes dans la base de données
			$data = $this->bdCommande->getHistoriqueCommande($pseudo);

            /*on reference la valeur pour pouvoir modifier le tableau
            dans la boucle*/
            foreach ($commandes as &$com)
            {
                foreach ($data as $d) {
                    $com['date'] = $d['date'];
                    $com['typeCommande'] = $d['typeCommande'];
                    $com['numCommande'] = $d['numCommande'];
                }
                $com["prix"] = $this->bdCommande->getPrixTotalCommande($com['numCommande']);
                $com["nbProduits"] = $this->bdCommande->getNbProduit($com['numCommande']);

            }
			include_once('vue/historiqueCommandes.php');
		}

		public function afficherCommande($numCommande)
		{
			$resultat = $this->bdCommande->getInfosCommande($numCommande);

            //Tester la valeur de retour de la fonction getInfos Commande
			if($resultat != false)
			{
                //Declaration de la variable dans ce bloc pour être trouvé dans l'inclusion de la vue
                $dateCommande = "null";

                foreach ($resultat as $res) {
                    $dateCommande = $res["date"];
                }

    			$prixCommande = $this->bdCommande->getPrixTotalCommande($numCommande);
                //Declaration de la variable dans ce bloc pour être trouvé dans l'inclusion de la vue
                $produits = array();

                //Pour chaque produit dans la commande
				foreach($resultat as $prod)
				{
					$p = $this->bdProduit->getInformationsProduit($prod["numProduit"]);
					$produit = array(
						"numProduit" => $p["numProduit"],
						"libelle" => $p["libelle"],
						"description" => $p["description"],
						"quantite" => $prod["quantite"],
						"prix" => $p["prix"],
						"prixTotal" => $p["prix"]* $prod["quantite"],
						"sourcePetit" => $p["sourcePetit"],
						"sourceMoyen" => $p["sourceMoyen"],
						"sourceGrand" => $p["sourceGrand"]
					);

					$produits[$prod["numProduit"]] = $produit;
				}

				include_once("vue/commande.php");
			}
			else
			{
				include_once("vue/404.php");
			}
		}

        public function recapCommande()
        {
            $produits = array();
            foreach($_SESSION["panier"] as $prod)
            {
                $p = $this->bdProduit->getInformationsProduit($prod["numProduit"]);
                $produit = array(
                    "numProduit" => $p["numProduit"],
                    "libelle" => $p["libelle"],
                    "description" => $p["description"],
                    "quantite" => $prod["quantite"],
                    "prix" => $p["prix"],
                    "prixTotal" => $p["prix"]* $prod["quantite"],
                    "sourcePetit" => $p["sourcePetit"],
                    "sourceMoyen" => $p["sourceMoyen"],
                    "sourceGrand" => $p["sourceGrand"]
                );
                $produits[$prod["numProduit"]] = $produit;
            }
            $prixCommande = $_SESSION["prixPanier"];

            include_once("vue/recapCommande.php");
        }
    }
?>
