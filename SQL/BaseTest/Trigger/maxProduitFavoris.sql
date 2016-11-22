CREATE TRIGGER `maxProduits` BEFORE INSERT ON `avis`
 FOR EACH ROW Begin 

DECLARE v_nb int;
DECLARE MAX_PRODUIT CONDITION FOR SQLSTATE '10000';
select COUNT(numproduit) into v_nb from preference where new.numuser = numuser;

if v_nb > 5 THEN
	SIGNAL MAX_PRODUIT
	SET MESSAGE_TEXT = 'Nombre maximum de produit favoris atteint';

end if;

End