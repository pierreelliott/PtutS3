CREATE TRIGGER `voteAvisSansCommentaire` BEFORE INSERT ON `vote`
FOR EACH ROW Begin 

DECLARE v_comm VARCHAR(1024);
DECLARE NO_VOTE CONDITION FOR SQLSTATE '11000';
select avis into v_comm from avis where new.numAvis = numuser;

if v_comm = NULL THEN
	SIGNAL NO_VOTE
	SET MESSAGE_TEXT = 'Pas de commentaire sur cet avis';

end if;

End;

/* Retourne une erreur sur alwaysdata.com
=>  #1235 - This version of MariaDB doesn't yet support 
'multiple triggers with the same action time and event for one table' */