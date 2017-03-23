<?php
    include_once('modele/PanierManager.php');
	require_once("modele/ProduitManager.php");

    class panierControleur
    {
        public $panier;
        public $produit;

        public function __construct()
        {
          	$this->panier = new PanierManager;
	        $this->produit = new ProduitManager;
        }

        public function afficherPanier()
        {
            $this->MajPanier();

  			$estVide = $this->panier->estVide();

  			$produits = array();
  			foreach($_SESSION["panier"] as $numProduit => $prod)
  			{
  				$qte = $prod["quantite"];
  				$p = $this->produit->getInformationsProduit($numProduit);

  				$produit = array(
					"numProduit" => $p["numProduit"],
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

  			$quantiteTotale = $this->panier->getQteTotale();
  			$prixTotal = $this->panier->getPrixPanier();
            $_SESSION["prixPanier"] = $prixTotal;
        	include_once('vue/panier.php');
        }

		function MajPanier()
		{
			if(isset($_POST["action"]) and isset($_POST["produit"]))
            {
				$numProduit = $_POST["produit"];

				switch ($_POST["action"])
				{
					case "ajout":
						$this->panier->ajouterProduit($numProduit);
						break;

					case "suppression":
						$this->panier->supprimerProduit($numProduit);
						break;

					case "modification":
						if(isset($_POST["qte"]))
						{
							$this->panier->changerQuantiteProduit($numProduit, $_POST["qte"]);
						}
						break;

					default : echo 'L\'action demandée n\'est pas reconnue';
				}
            }
		}

		function getInfosPanier()
		{
			if(isset($_POST["isAjax"]) and $_POST["isAjax"])
			{
				$this->MajPanier();

				$values = array();
				$values["panierVide"] = $this->panier->estVide();
				$values["prixPanier"] = $this->panier->getPrixPanier();
				$values["qtePanier"] = $this->panier->getQteTotale();
                $values["prixProduit"] = $this->produit->getInformationsProduit($_POST['produit'])['prix'];
				echo json_encode($values);
			}
			else
			{
				header("Location: /accueil");
			}
		}
    }
