/* Supression d'un avis qui a des votes et on verifie qu 'il n'y a pas de probleme avec les contraintes */
delete from avis 
    where NumAvis = 2;
