CREATE TRIGGER `ajoutVoteDate` AFTER INSERT ON `vote`
FOR EACH ROW Begin

declare v_date DATE;

set v_date = CURDATE();

update avis
	set dateDernierVote = v_date
	where numUser = new.numAvis;


End;
