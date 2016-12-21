CREATE TRIGGER `ajoutVoteDate` AFTER INSERT ON `vote`
FOR EACH ROW Begin


update avis
	set dateDernierVote = CURRENT_DATE()
	where numUser = new.numAvis;

end if;

End;
