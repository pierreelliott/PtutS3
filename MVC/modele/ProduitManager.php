<?php
    require_once("Model.php");

    class ProduitModel extends Model
    {
		public function getInformationsProduit($numProduit)
		{
			$requete = "select numProduit, libelle, description, prix, sourcePetit, sourceMoyen, sourceGrand from produit p join image i on p.numImage = i.numImage where numProduit = ?;";
			$resultat = $this->executerRequete($requete);
			$resultat = $resultat->fetch();

			return $resultat;
		}

		# Normalement, le principal devrait fonctionner (à voir !)
		public function ajouterProduit($libelle, $description, $typeProduit, $prix, $sourcePetit, $sourceMoyen, $sourceGrand, $compatibilite = null)
		{
			/*$resultat = $this->executerRequete('insert into image values(?, ?, ?)', array($sourcePetit, $sourceMoyen, $sourceGrand));
			$image = $this->executerRequete('select numImage from image where sourcePetit')*/
			/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
			/* !!!!! Comment ajouter les images pour un produit (contraintes clefs étrangères) ? !!!!! */
			/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */

			/* ===== J'ai une idée ===== */
			# À voir, parce que c'est très moche...
			$imagefactice = array($libelle."allo1",$libelle."allo2",$libelle."allo3");
			$image = $this->executerRequete('insert into image (sourcePetit, sourceMoyen, sourceGrand) values (?,?,?)', $imagefactice);
			$image = $this->executerRequete('select numImage from image where sourcePetit = ? and sourceMoyen = ? and sourceGrand = ?', $imagefactice);
			$numImage = $image->fetch();


            //Si le produit est gratuit (Contrainte)
            if($prix == null)
            {
                $prix = 0;
                # On considère qu'on a le $numImage
    			$resultat = $this->executerRequete('insert into produit (libelle,description,typeProduit,prix,numImage)
    								values (?,?,?,?,?)', array($libelle, $description, $typeProduit, $prix, $numImage));
            }

			if($compatibilite == null) // Je sais plus du tout à quoi ça sert....
			{

			}
		}

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
			$resultat = $resultat->fetch();

			# Si on supprime plus d'1 produit, on dit qu'il y a eu une erreur
			if($resultat == 1) return true;
			else return false;
		}

		public function modifierProduit($numProduit)
		{

		}

		public function ajouterCompatibilite()
		{

		}

		/* ============= Fonctions sur la carte des produits ============= */

		public function recupererCarte($tailleImage=null)
		{
			switch($tailleImage)
			{
			# Oui je me suis tapé un petit kiff,
			# on peut accorder en genre ou non le paramètre :-)
				case "grand":
				case "grande":
					$requete = "select numProduit, libelle, description, sourceGrand, prix from produit p join image i on p.numImage = i.numImage;";
				break;

				case "petit":
				case "petite":
				$requete = "select numProduit, libelle, description, sourcePetit, prix from produit p join image i on p.numImage = i.numImage;";

				case "moyen":
				case "moyenne":
				default:
				$requete = "select numProduit, libelle, description, sourceMoyen, prix from produit p join image i on p.numImage = i.numImage;";
			}
			$resultat = $this->executerRequete($requete);

			return $resultat;
		}
    }
