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
				// On test la présence des variables POST
				if
				(
					isset($_POST["numProduit"]) and isset($_POST["libelle"]) and
					isset($_POST["typeProduit"]) and isset($_POST["prix"]) and isset($_POST["description"])
				)
				{
					// Upload de l'image
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

					// On évite les failles XSS
					$numProduit = htmlspecialchars($_POST["numProduit"]);
					$libelle = htmlspecialchars($_POST["libelle"]);
					$typeProduit = htmlspecialchars($_POST["typeProduit"]);
					$prix = htmlspecialchars($_POST["prix"]);
					$description = htmlspecialchars($_POST["description"]);

					$produitMenu = array();
					$produitMenuQte = array();

					// On récupère les produits à ajouter dans le nouveau menu (si les tableaux sont vides c'est que l'on n'a pas ajouter un menu mais un produit seul)
					if(isset($_POST["lastNumProduit"]))
					{
						for($i = 0; $i <= $_POST["lastNumProduit"]; $i++)
						{
							if(isset($_POST["produitMenu".$i]) and isset($_POST["produitMenuQte".$i]))
							{
								$produitMenu[$i] = $_POST["produitMenu".$i];
								$produitMenuQte[$i] = $_POST["produitMenuQte".$i];
							}
						}

						$produitMenu = array_values($produitMenu);
						$produitMenuQte = array_values($produitMenuQte);
					}

					switch($_GET["action"])
					{
						case "ajout" :
							$this->bdd->ajouterProduit($libelle, $description, $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
							break;

						case "modification" :
							$this->bdd->modifierProduit($numProduit, $libelle, $description , $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
							break;

						case "suppression" :
							$this->bdd->supprimerProduit($numProduit);
							break;
					}
				}

				$typesProduit = $this->bdd->getTypesProduit(); // Utilisé dans la vue

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

		function getProduitAdmin()
		{
			if(isset($_POST["isAjax"]) and $_POST["isAjax"])
			{
				// Si on veut récupérer les infos d'un produit en particulier
				if(isset($_POST["numProduitAdmin"]))
				{
					$produit = $this->bdd->getInformationsProduit($_POST["numProduitAdmin"]);
					$typeProduit = $this->bdd->getTypeProduit($_POST["numProduitAdmin"]);

					if($typeProduit == "menu")
					{
						$produitsCompatibles = $this->bdd->getProduitsCompatibles($_POST["numProduitAdmin"]);

						foreach($produitsCompatibles as $keyProduit => $produitCompatible)
						{
							$produit["produits"][$keyProduit] = $this->bdd->getInformationsProduit($produitCompatible["numProduit2"]);
						}
					}

					echo json_encode($produit);
				}
				// Si on veut récupérer les infos de tous les produits
				else
				{
					$produits = $this->bdd->recupererCarte();
					foreach($produits as $key => $produit)
					{
						if($produit["prix"] < 0)
						{
							unset($produits[$key]);
							continue;
						}

						$typeProduit = $this->bdd->getTypeProduit($produit["numProduit"]);

						if($typeProduit == "menu")
						{
							unset($produits[$key]);
						}
					}

					// On défragmente le tableau pour avoir des index qui se suivent
					$produits = array_values($produits);

					echo json_encode($produits);
				}
			}
			else
			{
				header("Location: /");
			}
		}
    }
?>
