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

		      $produits = $this->bdd->recupererCarte();
          include_once('vue/administration.php');
      }

		  function remplirFormulaireModif()
		  {
			  $produit = $this->bdd->getInformationsProduit($_POST["numProduitAdmin"]);

			  echo json_encode($produit);
		  }
    }
?>
