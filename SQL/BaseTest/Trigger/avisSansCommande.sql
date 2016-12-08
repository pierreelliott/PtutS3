CREATE TRIGGER `avisSansCommande` BEFORE INSERT ON `avis`
FOR EACH ROW Begin

DECLARE v_nbCommande int;
DECLARE NO_AVIS CONDITION FOR SQLSTATE '12000';
select count(numcommande) into v_nbCommande from commande where new.NumUser = NumUser;

if v_nbCommande = 0 THEN
	SIGNAL NO_AVIS
	SET MESSAGE_TEXT = 'Impossible de poster un avis sans avoir acheté';

end if;

End;

/* Retourne une erreur sur alwaysdata.com
=>  #1235 - This version of MariaDB doesn't yet support
'multiple triggers with the same action time and event for one table' */
