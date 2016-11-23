CREATE TRIGGER `voteSonAvis` AFTER UPDATE ON `vote`
FOR EACH ROW Begin 

DECLARE NO_VOTE CONDITION FOR SQLSTATE '15000';

if new.numavis = numUser THEN
	SIGNAL NO_VOTE
	SET MESSAGE_TEXT = 'Impossible de voter sur son propre avis';


end if;

End;