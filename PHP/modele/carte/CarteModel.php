<?php
    include_once("modele/Model.php");

    class CarteModel extends Model
    {
        public function recupererCarte()
        {
            $requete = "select numProduit, libelle, description, sourceMoyen, prix from produit p join image i on p.numImage = i.numImage;";
            $resultat = $this->executerRequete($requete);

            return $resultat;
        }
    }