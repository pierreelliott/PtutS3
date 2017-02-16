<?php
    include_once('modele/ProduitManager.php');

    class AdminControleur
    {
  		public function __construct()
		{
			$this->bdd = new ProduitManager();
		}

		public function administrer()
		{
			if(isset($_SESSION["utilisateur"]["typeUser"]) and $_SESSION["utilisateur"]["typeUser"] == "ADMIN")
			{
				$imageProduit = null;

				if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
				{
					// On upload le fichier image s'il existe
					if ($_FILES['image']['size'] <= 1000000)
					{

						$infosfichier = pathinfo($_FILES['image']['name']);
						$extension_upload = $infosfichier['extension'];
						$extensions_autorisees = array('jpg', 'jpeg', 'png');
						if (in_array($extension_upload, $extensions_autorisees))
						{
							move_uploaded_file($_FILES['image']['tmp_name'], 'src/img/'.basename($_FILES['image']['name']));
							$imageProduit = 'src/img/'.basename($_FILES['image']['name']);
						}
					}
				}

				// On test la présence des variables POST
				if
				(
					isset($_POST["numProduit"]) and isset($_POST["libelle"]) and
					isset($_POST["typeProduit"]) and isset($_POST["prix"]) and isset($_POST["description"])
				)
				{
					// Pour chaque variable POST on regarde si elle est vide et on l'instancie à null le cas échéant
					$numProduit = htmlspecialchars($_POST["numProduit"]);
					$libelle = htmlspecialchars($_POST["libelle"]);
					$typeProduit = htmlspecialchars($_POST["typeProduit"]);
					$prix = htmlspecialchars($_POST["prix"]);
					$description = htmlspecialchars($_POST["description"]);

					switch($_GET["action"])
					{
						case "ajout" :
							$this->bdd->ajouterProduit($libelle, $description, $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit);
							break;
						case "modification" :
							$this->bdd->modifierProduit($numProduit, $libelle, $description , $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit);
							break;
						case "suppression" :
							$this->bdd->supprimerProduit($numProduit);
							break;
					}
				}

				$typesProduit = $this->bdd->getTypesProduit();

				$produits = $this->bdd->recupererCarte();

				$menus = array();
				foreach($produits as $keyMenu => $produit)
				{
					// Si le prix est négatif, on ne l'affichera pas
					// (peu importe que que ce soit un produit seul ou un menu)
					if($produit["prix"] < 0)
					{
						unset($produits[$keyMenu]);
						continue;
					}

					$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);

					// On teste le type du produit pour savoir si c'est un menu
					if(strcmp($typeProduit, "menu") == 0)
					{
						// Si le produit est un menu, on l'enlève de la carte
						unset($produits[$keyMenu]);

						// On récupère les informations du menu (libellé, description, prix)
						$menus[$keyMenu] = $this->bdd->getInformationsProduit($produit["numProduit"]);

						// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
						$produitCompatibles = $this->bdd->getProduitsCompatibles($produit["numProduit"]); // C'est un tableau des numProduits2

						// Pour chaque numProduit compatible, on récupère les informations du produit
						foreach($produitCompatibles as $keyProduit => $produitCompatible)
						{
							$menus[$keyMenu]["produits"][$keyProduit] = $this->bdd->getInformationsProduit($produitCompatible["numProduit2"]);
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
				include_once('vue/administration.php');
			}
			else
			{
				header("Location: /404");
			}
		}

		function remplirFormulaireModif()
		{
			if(isset($_POST["numProduitAdmin"]))
			{
				$produit = $this->bdd->getInformationsProduit($_POST["numProduitAdmin"]);
				$typeProduit = $this->bdd->getTypeProduit($_POST["numProduitAdmin"]);

				$produit["typeProduit"] = ucfirst($typeProduit);

				echo json_encode($produit);
			}
			else
			{
				header("Location: /accueil");
			}
		}
    }
?>
