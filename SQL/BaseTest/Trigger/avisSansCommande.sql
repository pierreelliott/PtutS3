CREATE TRIGGER `avisSansCommentaire` BEFORE INSERT ON `avis`
FOR EACH ROW Begin 

DECLARE v_nbCommande int;
DECLARE NO_AVIS CONDITION FOR SQLSTATE '12000';
select count(numcommande) into v_nbCommande from commandeEnregistree where new.numuser = numuser;

if v_nbCommande = 0 THEN
	SIGNAL NO_AVIS
	SET MESSAGE_TEXT = 'Impossible de poster un avis sans avoir acheté';

end if;

End;