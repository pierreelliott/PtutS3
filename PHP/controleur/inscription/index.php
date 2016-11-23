<?php
    include_once('modele/inscription/InscriptionModel.php');

    $bdd = new InscriptionModel();
    
    if(isset($_POST["pseudo"]) and isset($_POST["mdp"]) and isset($_POST["mdpConfirm"]) and isset($_POST["email"]))
    {
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $email = htmlspecialchars($_POST["email"]);
        
        $resultat = $bdd->getPseudo($pseudo);

        $inscriptionValide = true;
        
        // On vérifie que l'utilisateur a entré quelque chose
        if($_POST["pseudo"] == "" and $_POST["mdp"] == "" and $_POST["mdpConfirm"] == "" and $_POST["email"] == "")
        {
            echo "Veuillez remplir les champs.<br>";
            $inscriptionValide = false;
        }
        
        // On vérifie que la requête renvoie un résultat (le mot de passe est libre)
        if($resultat->rowCount() != 0)
        {
            echo "Ce pseudo n'est pas libre.<br>";
            $inscriptionValide = false;
        }

        // On vérifie que les deux mots de passe sont identiques
        if($_POST["mdp"] != $_POST["mdpConfirm"])
        {
            echo "Les deux mots de passe ne sont pas identiques. Veuillez ressaisir votre mot de passe.<br>";
            $inscriptionValide = false;
        }
        
        // On vérifie que l'email a une forme valide
        if(!preg_match("#[a-zA-Z0-9]+@[a-zA-Z]{2,}.[a-z]{2,4}#", $email))
        {
            echo "L'adresse email doit avoir une forme valide.<br>";
            $inscriptionValide = false;
        }
        
        // Si les données de l'inscription sont valides on fait l'inscription
        if($inscriptionValide)
        {
            $mdpHash = sha1($_POST["mdp"]);	
            $bdd->inscription($pseudo, $mdpHash, $email);

            header("Location: index.php");
        }  
    }

    include_once('vue/inscription/index.php');