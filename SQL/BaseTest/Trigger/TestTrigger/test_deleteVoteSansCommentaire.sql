/* Supression d'un avis qui a des votes et on verifie qu 'il n'y a pas de probleme avec les contraintes */
update avis
    set avis= NULL
     where numAvis = 2;
