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

		public function afficherHistorique()
		{
            /*Creation d'un tableau 2 dimension contenant
            toutes les commandes avec 2 colonnes en plus: prix et
            nbProduits
            1er dimension contient le nbCommande
            2ème les differentes colonne de la requete sql*/
            $commandes = array();

            //On recupere les commandes dans la base de données
			$data = $this->bdCommande->getHistoriqueCommande($_SESSION["utilisateur"]["pseudo"]);

                foreach ($data as $d) {


                    $com = array('date' => $d['date'],
                                 'typeCommande' => $d['typeCommande'],
                                 'numCommande'  => $d['numCommande'],
                                 'prix' => $this->bdCommande->getPrixTotalCommande($d['numCommande']),
                                 'nbProduits' => $this->bdCommande->getNbProduit($d['numCommande']));

                    //Ajout de la commande dans le tableau final
                    $commandes[$com['numCommande']] = $com;
                }


			include_once('vue/historiqueCommandes.php');
		}

		public function afficherCommande()
		{
			$resultat = $this->bdCommande->getInfosCommande($_GET["numCommande"]);

            //Tester la valeur de retour de la fonction getInfos Commande
			if($resultat != false)
			{
                //Declaration de la variable dans ce bloc pour être trouvé dans l'inclusion de la vue
                $dateCommande = "null";

                foreach ($resultat as $res) {
                    $dateCommande = $res["date"];
                }

    			$prixCommande = $this->bdCommande->getPrixTotalCommande($_GET["numCommande"]);
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
                    //Ajout d'un tableau en 2 dimensions avec toutes les donnees
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
