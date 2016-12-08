CREATE TRIGGER `voteConditions` BEFORE INSERT ON `vote`
FOR EACH ROW Begin 

DECLARE NO_VOTE CONDITION FOR SQLSTATE '15000';

DECLARE NO_VOTE2 CONDITION FOR SQLSTATE '13000';
DECLARE v_nbVote int;
select count(numUser) into v_nbVote from vote where numavis = new.numavis and numuser = new.numuser;

DECLARE v_comm VARCHAR(1024);
DECLARE NO_VOTE CONDITION FOR SQLSTATE '11000';
select avis into v_comm from avis where new.numAvis = numuser;

if new.numavis = numUser THEN
	SIGNAL NO_VOTE
	SET MESSAGE_TEXT = 'Impossible de voter sur son propre avis';


end if;

if v_nbVote > 0 THEN
	SIGNAL NO_VOTE2
	SET MESSAGE_TEXT = 'Impossible de voter plusieurs fois sur le même avis';


end if;

if v_comm = NULL THEN
	SIGNAL NO_VOTE
	SET MESSAGE_TEXT = 'Pas de commentaire sur cet avis';

end if;

End;
