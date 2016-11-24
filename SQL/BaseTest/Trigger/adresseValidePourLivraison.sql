CREATE TRIGGER `adresseValidePourLivraison` BEFORE INSERT ON `commande`
FOR EACH ROW Begin 

DECLARE NO_ADRESSE CONDITION FOR SQLSTATE '14000';

if UPPER(new.typecommande) = "LIVRAISON" and (new.rue = NULL or new.ville = NULL or new.numrue = NULL or new.codepostal = NULL) THEN
	SIGNAL NO_ADRESSE
	SET MESSAGE_TEXT = 'Nécessite une adresse valide';


end if;

End;