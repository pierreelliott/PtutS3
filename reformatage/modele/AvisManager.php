<?php
    require_once("Model.php");
    require_once("UserManager.php");

    public class avisManager extends Model
    {
        public userManager $um = new userManager();
		
		
		require_once("AvisManager/fonctions.php");
		
		/* ======= Description fonctions ======
		
		######## (j'ai l'impression qui manque des trucs)
		//Ajouter un avis
		#  public function addAvis($commentaire, $pseudo, $note)
		{return 	- true si insertion réussie
					- false si erreur trigger
		}
		
		########
		//Modifier avis
		# public function modifAvis($commentaire, $pseudo, $note)
		{return [...]}
		
		########
		//L'utilisateur vote
		# public function addVote($numAvis, $vote, $pseudo)
		{return 	- true si insertion réussie
					- false si erreur tiggers
		}
		
		########
		//Recupere l'avis en fonction du pseudo de l'utilisateur
		# public function getAvis($pseudo)
		{return avis (texte de l'avis), note, date}
		*/
    }
 ?>