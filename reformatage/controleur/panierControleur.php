<?php
    include_once('modele/PanierManager.php');
    
    //session_start();
	
	class panierControleur
	{
		public $panier;
		
		public function __construct()
		{
			$this->panier = new PanierManager;
		}
		
		public function afficherPanier()
		{
			if(isset($_GET["action"]) && isset($_GET["produit"]))
			{
				$tabParams = explode(',', $_GET["produit"]);
				if(count($tabParams) != 5 and count($tabParams) != 6)
				{
					echo "Le produit n'est pas reconnu";
				}
				else
				{
					switch ($_GET["action"])
					{
						case "ajout":
							$this->panier->ajouterProduit($tabParams);
						break;
						
						case "suppression":
							$this->panier->supprimerProduit($tabParams);
							
							/*$tmp = array();
							$tmp["libelle"] = array();
							$tmp["quantite"] = array();
							$tmp["prix"] = array();

							for($i = 0; $i < count($_SESSION["panier"]["libelle"]); $i++)
							{
							   if ($_SESSION["panier"]["libelle"][$i] !== $tabParams[1])
							   {
								  array_push( $tmp["libelle"],$_SESSION["panier"]["libelle"][$i]);
								  array_push( $tmp["quantite"],$_SESSION["panier"]["quantite"][$i]);
								  array_push( $tmp["prix"],$_SESSION["panier"]["prix"][$i]);
							   }
							}
							//On remplace le panier en session par notre panier temporaire à jour
							$_SESSION["panier"] =  $tmp;
							//On efface notre panier temporaire
							unset($tmp);*/
						break;
						
						case "modification":
							$panier->changerQuantiteProduit($tabParams[1], 1);
							# Nécessite une modification supérieure (ajouter la quantité en paramètre)
						
						default : echo 'L\'action demandée n\'est pas reconnue';
					}
				}      
			}
			
			include_once('vue/panier.php');
		}
	}
	
	
    
    