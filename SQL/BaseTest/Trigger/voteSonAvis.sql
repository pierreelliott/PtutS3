CREATE TRIGGER `voteSonAvis` BEFORE INSERT ON `vote`
FOR EACH ROW Begin 

DECLARE NO_VOTE CONDITION FOR SQLSTATE '15000';

if new.numavis = numUser THEN
	SIGNAL NO_VOTE
	SET MESSAGE_TEXT = 'Impossible de voter sur son propre avis';


end if;

End;

/* Retourne une erreur sur alwaysdata.com
=>  #1235 - This version of MariaDB doesn't yet support 
'multiple triggers with the same action time and event for one table' */