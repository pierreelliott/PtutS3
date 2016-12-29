<?php
    require_once('modele/UserManager.php');

    //session_start();
	
	class connexionControleur
	{
		protected $bdd = new UserManager();
		
		public function connexion()
		{
			if(isset($_POST["mdp"]) and isset($_POST["pseudo"]))
			{
				$pseudo = htmlspecialchars($_POST["pseudo"]);
				$mdpHash = sha1($_POST["mdp"]);

				$resultat = $bdd->connexion($pseudo, $mdpHash);

				if($resultat->rowCount() > 0)
				{
					$tabRows = $resultat->fetchAll(PDO::FETCH_ASSOC);

					session_start();
					$_SESSION["numClient"] = $tabRows["numClient"];
					$_SESSION["pseudo"] = $pseudo;

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

    

    
