<?php
    include_once('modele/panier/PanierModel.php');
    
    $bdd = new PanierModel();
    
    //$resultat = $bdd->recupererPanier();
    //$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);
    
    include_once('vue/panier/index.php');

