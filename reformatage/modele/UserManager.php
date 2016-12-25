<?php
    require_once("Model.php");
    public class UserManager extends Model
    {
		require_once("UserManager/fonctions.php");
		
		/* ===== Description fonctions =====
		
		##########
		//Teste les logs de connexion à la BD
		# public function connexion($pseudo, $mdpHash)
		{return [...]}
		
		##########
		//Ajoute le nouveau utilisateur à la BD
		# public function inscription($pseudo, $mdpHash, $nom, $prenom, $email,
									$tel, $numRue, $rue, $ville, $codePostal)
		{return 	- true si insertion réussie
					- false si insertion fail
		}
		
		##########
		# public function getPseudo($pseudo)
		{return pseudo}
		
		##########
		//Permet de recuperer le NumUser à partir du pseudo
		# public function getNumUser($pseudo)
		{return numUser}
		
		##########
		//Recupere les informations de l'user
		# public function getInfo($pseudo)
		{return nom, prenom, mail, ville, rue, codePostal, telephone, pseudo, numRue, dateInscription}
		
		##########
		//Recupere les produits favoris de l'utilisateur
		# public function getProduitsFavoris($pseudo)
		{return numImage, description, prix, libelle, typeProduit}
		
		*/
    }
?>