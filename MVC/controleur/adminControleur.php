<?php
    include_once('modele/ProduitManager.php');
    include_once('modele/AvisManager.php');
    include_once('modele/AvisManager.php');

    class AdminControleur
    {
  		public function __construct()
		{
			$this->produit = new ProduitManager();
            $this->avis = new AvisManager();
            $this->user = new UserManager();
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
					}

					switch($_GET["action"])
					{
						case "ajout" :
							$this->produit->ajouterProduit($libelle, $description, $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
							header("Location: /administration");
							break;

						case "modification" :
							$this->produit->modifierProduit($numProduit, $libelle, $description , $typeProduit, $prix, $imageProduit, $imageProduit, $imageProduit, $produitMenu, $produitMenuQte);
							header("Location: /administration");
							break;

						case "suppression" :
							$this->produit->supprimerProduit($numProduit);
							header("Location: /administration");
							break;
					}
				}
                // ========================= Recuperation des données pour les avis =========================================

                //On recupere tous les avis signaler
                $tousAvisBD = $this->avis->getTousAvisSignaler();
                $tousAvis = array();
                if($tousAvisBD != false)
                {
                foreach ($tousAvisBD as $avisBD)
                {
                    //Creation d'un tableau pour stocker toutes les informations d'un avis + remplissage
                    $avis = array('avis' => $avisBD['avis'],
                                    'note' => $avisBD['note'],
                                    'date'  => $avisBD['date'],
                                    'numuser' =>  $avisBD['numAvis'],
                                    'pseudo' => $this->user->getPseudo($avisBD['numAvis']),
                                    'signalement' => $this->avis->getSignalements($avisBD['numAvis']),
                                    'estCommente' => isset($avisBD['avis']) == true );



                    //Ajout d'un tableau en 2 dimensions avec toutes les donnees
                    $tousAvis[$avisBD['numAvis']] = $avis;
                }
                }
                else {
                    $tousAvis = false;
                }


				$typesProduit = $this->produit->getTypesProduit(); // Utilisé dans la vue

				$produits = $this->produit->recupererCarte();

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

					$typeProduit = $this->produit->getTypeProduit($produit["numProduit"]);

					// On teste le type du produit pour savoir si c'est un menu
					if(strcmp($typeProduit, "menu") == 0)
					{
						// Si le produit est un menu, on l'enlève de la carte
						unset($produits[$keyMenu]);

						// On récupère les informations du menu (libellé, description, prix)
						$menus[$keyMenu] = $this->produit->getInformationsProduit($produit["numProduit"]);

						// On récupère les numéros des produits compatibles du menu (donc les produits contenus dans le menu)
						$produitCompatibles = $this->produit->getProduitsCompatibles($produit["numProduit"]); // C'est un tableau des numProduits2

						// Pour chaque numProduit compatible, on récupère les informations du produit
						foreach($produitCompatibles as $keyProduit => $produitCompatible)
						{
							$menus[$keyMenu]["produits"][$keyProduit] = $this->produit->getInformationsProduit($produitCompatible["numProduit2"]);
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
					$produit = $this->produit->getInformationsProduit($_POST["numProduitAdmin"]);
					$typeProduit = $this->produit->getTypeProduit($_POST["numProduitAdmin"]);

					if($typeProduit == "menu")
					{
						$produitsCompatibles = $this->produit->getProduitsCompatibles($_POST["numProduitAdmin"]);

						foreach($produitsCompatibles as $keyProduit => $produitCompatible)
						{
							$produit["produits"][$keyProduit] = $this->produit->getInformationsProduit($produitCompatible["numProduit2"]);
						}
					}

					echo json_encode($produit);
				}
				// Si on veut récupérer les infos de tous les produits
				else
				{
					$produits = $this->produit->recupererCarte();
					foreach($produits as $key => $produit)
					{
						if($produit["prix"] < 0)
						{
							unset($produits[$key]);
							continue;
						}

						$typeProduit = $this->produit->getTypeProduit($produit["numProduit"]);

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

		public function rechercherPseudo()
		{
			$input = $_POST["input"];

			$pseudos = $this->user->getListePseudos($input);

			echo json_encode($pseudos);
		}

        function deleteCommentaire()
        {
            //On verifie que l'utilisateur soit connecté et que c'est un administrateur
            if(isset($_SESSION["utilisateur"]["typeUser"]) and $_SESSION["utilisateur"]["typeUser"] == "ADMIN")
            {
                //On teste que le numAvis existe
                if(isset($_POST['numAvis']))
                {
                    //Supression des commentaires
                    $this->avis->deleteCommentaire($_POST['numAvis']);

                    //Supression des signalements relatif a cet avis et on stocke le resultat de la suppression
                    $retour = $this->avis->deleteSignalements($_POST['numAvis']);
                }
            }
            header('Location: /administration');
        }

        function modifCommentaire()
        {
            //On verifie que l'utilisateur soit connecté et que c'est un administrateur
            if(isset($_SESSION["utilisateur"]["typeUser"]) and $_SESSION["utilisateur"]["typeUser"] == "ADMIN")
            {
                //Test que les valeurs sont passé en parametre
                if(isset($_POST["numAvis"]) && isset($_POST["commentaire"]))
                {
                    $this->avis->modifCommentaire($_POST["numAvis"], $_POST["commentaire"]);

                    //Supression des signalements relatif a cet avis et on stocke le resultat de la suppression
                    $retour = $this->avis->deleteSignalements($_POST['numAvis']);
                }
            }
            header('Location: /administration');
        }
    }
?>
