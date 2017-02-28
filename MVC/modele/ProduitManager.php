<?php
    require_once("Model.php");

    class ProduitManager extends Model
    {
		public function getInformationsProduit($numProduit)
		{
			$requete = "select numProduit, libelle, description, typeProduit, prix, p.numImage numImage, sourcePetit, sourceMoyen, sourceGrand from produit p left join image i on p.numImage = i.numImage where numProduit = ?;";
			$resultat = $this->executerRequete($requete, array($numProduit));
			$resultat = $resultat->fetch(PDO::FETCH_ASSOC);

			return $resultat;
		}

		public function rechercherProduits($libelleProduit)
		{
			$requete = "select numProduit, libelle, description, typeProduit, prix, p.numImage numImage, sourcePetit, sourceMoyen, sourceGrand from produit p join image i on p.numImage = i.numImage where libelle like ?;";
			$resultat = $this->executerRequete($requete, array("$libelleProduit%"));
			$resultat = $resultat->fetchAll(PDO::FETCH_ASSOC);

			return $resultat;
		}

		# Normalement, le principal devrait fonctionner (à voir !)
		public function ajouterProduit($libelle, $description, $typeProduit, $prix, $sourcePetit, $sourceMoyen, $sourceGrand, $produitsMenu = array(), $produitsMenuQte = array())
		{
			/*$resultat = $this->executerRequete('insert into image values(?, ?, ?)', array($sourcePetit, $sourceMoyen, $sourceGrand));
			$image = $this->executerRequete('select numImage from image where sourcePetit')*/
			/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
			/* !!!!! Comment ajouter les images pour un produit (contraintes clefs étrangères) ? !!!!! */
			/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */

			/* ===== J'ai une idée ===== */
			// À voir, parce que c'est très moche...
			$imagefactice = array($libelle."allo1",$libelle."allo2",$libelle."allo3");
			$image = $this->executerRequete('insert into image (sourcePetit, sourceMoyen, sourceGrand) values (?,?,?)', $imagefactice);
			$image = $this->executerRequete('select numImage from image where sourcePetit = ? and sourceMoyen = ? and sourceGrand = ?', $imagefactice);
			$numImage = $image->fetch(PDO::FETCH_ASSOC)["numImage"];


			//Si le produit est gratuit (Contrainte)
			if($prix == null)
			{
				$prix = 0;
			}

			// Si le type de produit n'existe pas dans la BD (possible uniquement si on ajoute un menu)
			if(empty($this->executerRequete('select libelle from typeproduit where libelle = ?', array($typeProduit))->fetchAll(PDO::FETCH_ASSOC)))
			{
				$typeProduit = 'Menu.'.$typeProduit;
				$this->executerRequete('insert into typeproduit values (?)', array($typeProduit));
			}

			// On considère qu'on a le $numImage
			$resultat = $this->executerRequete('insert into produit (libelle,description,typeProduit,prix,numImage)
  						values (?,?,?,?,?)', array($libelle, $description, $typeProduit, $prix, $numImage));

			// Apparement la quantité de produit dans un menu n'est pas gérée dans la BD mais bon je laisse comme ça au cas où
			if(!empty($produitsMenu) and !empty($produitsMenuQte))
			{
				$numProduit = $this->executerRequete('select numProduit from produit where libelle = ? and description = ? and typeProduit = ? and prix = ?',
						array($libelle, $description, $typeProduit, $prix));
				$numProduit = $numProduit->fetch(PDO::FETCH_ASSOC)["numProduit"];

				for($i = 0; $i < count($produitsMenu); $i++)
				{
					$this->ajouterCompatibilite($numProduit, $produitsMenu[$i]);
				}
			}
		}

        //Supression d'un produit (Admin): Passage du prix en négatif
		public function supprimerProduit($numProduit)
		{
			$produit = $this->getInformationsProduit($numProduit);
			$prix = floatval((-1)*floatval($produit["prix"]));

			$requete = "update produit set prix = :prix where numProduit = :numProduit";
			$params = array(
					'prix' => $prix,
					'numProduit' => $numProduit
					);
			$resultat = $this->executerRequete($requete, $params);
			//$resultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
			//print_r($resultat);

			# Si on supprime plus d'1 produit, on dit qu'il y a eu une erreur
			//if($resultat == 1) return true;
			//else return false;
		}

        //Si les valeurs ne sont modifiés ont renvoi les valeurs déja presente
		public function modifierProduit($numProduit, $libelle, $description , $typeProduit, $prix, $sourcePetit, $sourceMoyen, $sourceGrand)
		{
			// Si aucune image n'est envoyée on ne la modifie pas
			if($sourcePetit != null and $sourceMoyen != null and $sourceGrand != null)
			{
				$numImage = $this->getInformationsProduit($numProduit)["numImage"];

				$requeteImage = $this->executerRequete('update image
														set sourcePetit = ?, sourceMoyen = ?, sourceGrand = ?
														where numImage = ?',
														array($sourcePetit, $sourceMoyen, $sourceGrand, $numImage));
			}

            $requete = $this->executerRequete('update produit
                                            set libelle = ?, description = ?, typeProduit = ?, prix = ?
											where numProduit = ?',
                                            array($libelle, $description , $typeProduit, $prix, $numProduit));
            return $requete;
		}

		public function ajouterCompatibilite($numProduit, $numProduit2)
		{
            /* Exemple Un produit avec une sauce ou assaisonnement
			Plusieurs produits pour un menu une table Menu
			Plusieurs produits donnent des reductions
			Depends aussi de la categorie du produit par exemple accompagnement*/

			$requete = 'insert into compatibilite (numProduit, numProduit2) values (?, ?)';
			$this->executerRequete($requete, array($numProduit, $numProduit2));
		}

		public function getTypeProduit($numProduit)
		{
			//Les menus sont stockés dans la base
			//avec un type dans le style : "menu.[...]"
			$requete = $this->executerRequete('select lower(TYPEPRODUIT) typeProduit from produit
                                            where numProduit= ?', array($numProduit));
            $resultat = $requete->fetch(PDO::FETCH_ASSOC);

            //Tableau contenant le type produit en 2 chaines
            $partie = explode(".", $resultat["typeProduit"]);

            //Si le tableau est vide ou le delimiter n'a pas été trouvé
            if(empty($partie) || $partie == false)
            {
                return "produit";
            }
            else
            {
                //On regarde si le premier segement est un menu
                if(strcmp($partie[0], "menu") == 0)
                {
                    return "menu";
                }
                else
				{
                    return $partie[0];
                }
            }

			//Return : une chaine (à repréciser si jamais)
		}

		public function getTypesProduit()
		{
			$requete = $this->executerRequete('select libelle from typeproduit');
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

			$typesProduit = array();
			foreach($resultat as $key => $typeProduit)
			{
				//Tableau contenant le type produit en 2 chaines
	            $partie = explode(".", $typeProduit["libelle"]);

				$typeProduit["libelle"] = $partie[0];

				$typesProduit[$key] = $typeProduit["libelle"];
			}

			return $typesProduit;
		}

		public function getProduitsCompatibles($numProduit)
		{
			// Table compatibilite :
			// Colonne 1 : $numProduit ; colonne 2 : les produits compatibles
            $requete = $this->executerRequete('select numProduit2 from compatibilite
                                            where numProduit = ?', array($numProduit));

            $resultat =  $requete->fetchAll(PDO::FETCH_ASSOC);

            return $resultat;
			// Return array des numProduit compatibles
		}

		/* ============= Fonctions sur la carte des produits ============= */

		public function recupererCarte($tailleImage=null)
		{
			// Il faut qu'on change la requête parce que s'il n'y pas d'image, le produit n'est pas pris en compte...
			switch($tailleImage)
			{
			# Oui je me suis tapé un petit kiff,
			# on peut accorder en genre ou non le paramètre :-)
				case "grand":
				case "grande":
					$requete = "select numProduit, libelle, description, sourceGrand, prix from produit p left join image i on p.numImage = i.numImage;";
				break;

				case "petit":
				case "petite":
				$requete = "select numProduit, libelle, description, sourcePetit, prix from produit p left join image i on p.numImage = i.numImage;";

				case "moyen":
				case "moyenne":
				default:
				$requete = "select numProduit, libelle, description, sourceMoyen, prix from produit p left join image i on p.numImage = i.numImage;";
			}
			$resultat = $this->executerRequete($requete);
			$resultat = $resultat->fetchAll(PDO::FETCH_ASSOC);

			return $resultat;
		}
    }
