CREATE TRIGGER `maxProduits` BEFORE INSERT ON `preference`
FOR EACH ROW Begin 

DECLARE v_nb int;
DECLARE MAX_PRODUIT CONDITION FOR SQLSTATE '10000';
select COUNT(numproduit) into v_nb from preference where new.numuser = numuser;

if v_nb > 10 THEN
	SIGNAL MAX_PRODUIT
	SET MESSAGE_TEXT = 'Nombre maximum de produit favoris atteint';

end if;

End;

/* End;/ 
Fonctionne sans le slash à la fin,
il suffit de changer le délimiteur dans la console sql de phpmyadmin */