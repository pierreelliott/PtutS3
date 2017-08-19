<?php

namespace Models;

class ProductManagerPDO extends ProductManager
{
	public function getMenuCard($imageSize = null)
	{
		switch($imageSize)
		{
			# Oui je me suis tapé un petit kiff,
			# on peut accorder en genre ou non le paramètre :-)
			case 'grand':
			case 'grande':
				$size = 'Grand';
			break;

			case 'petit':
			case 'petite':
				$size = 'Petit';

			case 'moyen':
			case 'moyenne':
			default:
				$size = 'Moyen';
		}
		$sql = 'select numProduit, libelle, description, source'.$size.', prix, lower(typeProduit) as typeProduit from produit p left join image i on p.numImage = i.numImage';
		$requete = $this->dao->query($sql);
		$carte = $requete->fetchAll(\PDO::FETCH_ASSOC);
		$requete->closeCursor();

		return $carte;
	}

	public function getCompatibleProducts($productNo)
	{
		// Table compatibilite :
		// Colonne 1 : $productNo ; colonne 2 : les produits compatibles
        $requete = $this->dao->prepare('select numProduit2 from compatibilite where numProduit = ?');
		$requete->execute(array($productNo));

        $resultat = $requete->fetchAll(\PDO::FETCH_ASSOC);

        return $resultat;
	}

	public function getProductInformations($productNo)
	{
		$sql = "select numProduit, libelle, description, typeProduit, prix, p.numImage numImage, sourcePetit, sourceMoyen, sourceGrand from produit p left join image i on p.numImage = i.numImage where numProduit = ?;";
		$requete = $this->dao->prepare($sql);
		$requete->execute(array($productNo));

		return $requete->fetch(\PDO::FETCH_ASSOC);
	}

	public function isMenu($productNo)
	{
		$productType = $this->getProductInformations($productNo)['typeProduit'];

		return explode('.', strtolower($productType))[0] == 'menu';
	}

	public function searchProduct($wording)
	{
		$sql = 'select numProduit, libelle, description, typeProduit, prix, p.numImage numImage, sourcePetit, sourceMoyen, sourceGrand from produit p join image i on p.numImage = i.numImage where libelle like ?';
		$requete = $this->dao->prepare($sql);
		$requete->execute(array("$wording%"));

		return $requete->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getProductTypes()
	{
		$requete = $this->dao->query('select libelle from typeProduit');
        $resultat = $requete->fetchAll(\PDO::FETCH_ASSOC);

		$typesProduit = array();
		foreach($resultat as $key => $typeProduit)
		{
			//Tableau contenant le type produit en 2 chaines
            /*$partie = explode(".", $typeProduit["libelle"]);

			$typeProduit["libelle"] = $partie[0];*/

			$typesProduit[$key] = $typeProduit['libelle'];
		}

		return $typesProduit;
	}
}