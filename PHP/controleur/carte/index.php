<?php
    include_once('modele/carte/CarteModel.php');
    
    $bdd = new CarteModel();
    
    $resultat = $bdd->recupererCarte();
    $tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);

    include_once('vue/carte/index.php');