<?php
    include_once('modele/inscription/InscriptionModel.php');

    session_start();
    
    $bdd = new InscriptionModel();
    
    if(
        isset($_POST["pseudo"]) and isset($_POST["mdp"]) and isset($_POST["mdpConfirm"]) and
        isset($_POST["nom"]) and isset($_POST["prenom"]) and
        isset($_POST["email"]) and isset($_POST["tel"]) and
        isset($_POST["numRue"]) and isset($_POST["rue"]) and isset($_POST["ville"]) and isset($_POST["codePostal"])
      )
    {
        $inscriptionValide = true;
        
        // On vérifie que l'utilisateur a entré quelque chose
        if(
            $_POST["pseudo"] == "" and $_POST["mdp"] == "" and $_POST["mdpConfirm"] == "" and
            $_POST["nom"] == "" and $_POST["prenom"] == "" and
            $_POST["email"] == "" and $_POST["tel"] == ""
          )
        {
            $message = "Un ou plusieurs champs obligatoires ne sont pas remplis.<br>";
            $inscriptionValide = false;
        }
        
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $tel = htmlspecialchars($_POST["tel"]);
        $rue = htmlspecialchars($_POST["rue"]);
        $ville = htmlspecialchars($_POST["ville"]);
        $codePostal = htmlspecialchars($_POST["codePostal"]);
        
        $resultat = $bdd->getPseudo($pseudo);
        
        // On vérifie que le pseudo est libre (la requête ne renvoie pas de résultat)
        if($resultat->rowCount() != 0)
        {
            $message = "Ce pseudo n'est pas libre.<br>";
            $inscriptionValide = false;
        }

        // On vérifie que les deux mots de passe sont identiques
        if($_POST["mdp"] != $_POST["mdpConfirm"])
        {
            $message = "Les deux mots de passe ne sont pas identiques. Veuillez ressaisir votre mot de passe.<br>";
            $inscriptionValide = false;
        }
        
        // On vérifie que l'email a une forme valide
        if($email != "" and !preg_match("#[a-zA-Z0-9]+@[a-zA-Z]{2,}.[a-z]{2,4}#", $email))
        {
            $message = "L'adresse email doit avoir une forme valide.<br>";
            $inscriptionValide = false;
        }
        
        // On vérifie que le téléphone contient bien 10 chiffres
        if($tel != "" and ! preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $tel))
        {
            $message = "Le numéro de téléphone doit avoir une forme valide.<br>";
            $inscriptionValide = false;
        }
        
        // Si les données de l'inscription sont valides on fait l'inscription
        if($inscriptionValide)
        {
            $mdpHash = sha1($_POST["mdp"]);	
            $bdd->inscription($pseudo, $mdpHash, $nom, $prenom, $email, $_POST["tel"], $_POST["numRue"], $rue, $ville, $_POST["codePostal"]);

            header("Location: index.php");
        }  
    }

    include_once('vue/inscription/index.php');