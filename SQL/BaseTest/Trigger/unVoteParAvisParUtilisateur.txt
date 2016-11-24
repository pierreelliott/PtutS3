CREATE TRIGGER `voteParAvisParUtilisateur` BEFORE INSERT ON `vote`
FOR EACH ROW Begin 

DECLARE NO_VOTE2 CONDITION FOR SQLSTATE '13000';
DECLARE v_nbVote int;
select count(numUser) into v_nbVote from vote where numavis = new.numavis and numuser = new.numuser;

if v_nbVote > 0 THEN
	SIGNAL NO_VOTE2
	SET MESSAGE_TEXT = 'Impossible de voter plusieurs fois sur le même avis';


end if;

End;