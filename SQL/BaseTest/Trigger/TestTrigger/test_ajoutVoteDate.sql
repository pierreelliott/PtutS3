/* Ajout d'un vote et on verifie si la date du dernier vote a changé */

select dateDernierVote from avis
where numUser = 3;

insert into vote(numAvis, numUser, vote)
    values(3, 2, true);
    
select dateDernierVote from avis
where numUser = 3;
