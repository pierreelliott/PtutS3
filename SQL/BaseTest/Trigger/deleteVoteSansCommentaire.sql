CREATE TRIGGER `deleteVoteSansCommentaire` AFTER UPDATE ON `avis`
FOR EACH ROW Begin

DECLARE v_comm VARCHAR(1024);
select avis into v_comm from avis where new.numuser = numuser;

if v_comm = NULL THEN
	DELETE from vote where numAvis = new.numuser;

end if;

End;
