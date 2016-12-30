<?php
    require_once('modele/UserManager.php');

    //session_start();
	
    class connexionControleur
    {
        protected $bdd;

        public function __construct()
        {
            $this->bdd = new UserManager;
        }

        public function connexion()
        {
            if(isset($_POST["mdp"]) and isset($_POST["pseudo"]))
            {
                $pseudo = htmlspecialchars($_POST["pseudo"]);
                $mdpHash = sha1($_POST["mdp"]);

                $resultat = $this->bdd->connexion($pseudo, $mdpHash);

                // Si la connexion a réussi (la requête renvoie une ligne)
                if($resultat->rowCount() > 0)
                {
                    // tabRows contient un tableau dont chaque élément est une ligne renvoyée sous forme de tableau
                    // tabRows est donc une matrice ne contenant qu'une ligne
                    $tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);

                    $_SESSION["utilisateur"] = $tabRows[0];

                    // Si l'utilisateur coche la case de connexion automatique
                    if(isset($_POST["connAuto"]))
                    {
                            setcookie("pseudo", $pseudo);
                            setcookie("mdpHash", $mdpHash);
                    }

                    header("Location: index.php");
                }
                else
                {
                    $message = "Pseudo ou mot de passe incorrects.";
                }
            }

            include_once('vue/connexion.php');
        }
    }

    

    
