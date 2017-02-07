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

				$nom = $infos[0];
				$prenom = $infos[1];
				$mail = $infos[2];
				$ville = $infos[3];
				$rue = $infos[4];
				$codePostal = $infos[5];
				$telephone = $infos[6];
				$numRue = $infos[8];
				$dateInscription = $infos[9];

				include_once('vue/utilisateur.php');
			}
			else
			{
				include_once('vue/demandeConnexion.php');
			}
		}


	}
