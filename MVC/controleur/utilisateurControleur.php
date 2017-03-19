<?php

    require_once('modele/UserManager.php');

	class utilisateurControleur
	{
		protected $bdd;

		public function __construct()
		{
			$this->bdd = new UserManager();
		}

		public function afficherInfos()
		{
			if(isset($_SESSION["utilisateur"]))
			{
				$pseudo = $_SESSION["utilisateur"]["pseudo"];
				$infos = $this->bdd->getInfo($pseudo);

				$nom = $infos["nom"];
				$prenom = $infos["prenom"];
				$mail = $infos["mail"];
				$ville = $infos["ville"];
				$rue = $infos["rue"];
				$codePostal = $infos["codePostal"];
				$telephone = $infos["telephone"];
				$numRue = $infos["numRue"];
				$dateInscription = $infos["dateInscription"];

				include_once('vue/utilisateur.php');
			}
			else
			{
				include_once('vue/demandeConnexion.php');
			}
		}

		// Permet de modifier le mot de passe d'un utilisateur
		public function modifierMdp()
		{
			$pseudo = $_POST["pseudoModifMdp"];
			$oldMdp = sha1($_POST["oldMdp"]);
			$newMdp = $_POST["newMdp"];
			$confirmNewMdp = $_POST["confirmNewMdp"];

			// On récupère le mot de passe
			$checkMdp = $this->bdd->getInfo($pseudo)["mdp"];

			if($checkMdp == $oldMdp && $newMdp == $confirmNewMdp)
			{
				$this->bdd->modifierInfos($this->bdd->getNumUser($pseudo), array("mdp" => sha1($newMdp)));
			}

			header("Location: /utilisateur");
		}
	}
