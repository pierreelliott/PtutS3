<?php

namespace Models;

if(session_status() == PHP_SESSION_NONE)
	session_start();

class AdviceManagerPDO extends AdviceManager
{
    public function getAdvice($userNo)
    {
        $requete = $this->dao->prepare('select avis, note, date from avis where numUser = ?');
        $requete->execute(array($userNo));

        return $requete->fetch();
    }

    public function getAllAdvices($criterion = 'date', $order = 'desc')
    {
        $sql = 'select avis, note,  DATE_FORMAT(date, \'%d/%m/%Y\') date, numUser from avis order by ? ?';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($criterion, $order));

        return $requete->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPositiveVotes($adviceNo)
    {
        $sql = 'select IFNULL(count(vote), 0) votePositif from vote where vote = 1 and numAvis = ?';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($adviceNo));
        $vote = $requete->fetch();

        return $vote["votePositif"];
    }

    public function getNegativeVotes($adviceNo)
    {
        $sql = 'select IFNULL(count(vote), 0) voteNegatif from vote where vote = 0 and numAvis = ?';
        $requete = $this->dao->prepare($sql);
        $requete->execute(array($adviceNo));
        $vote = $requete->fetch();

        return $vote["voteNegatif"];
    }

	public function addAdvice($comment, $userNo, $mark)
	{
		// Test si l'utilisateur n'a pas déjà donné un avis
		$requete = $this->dao->prepare('select numUser from avis where numUser in (select numUser from utilisateur where numUser = ?)');
		$requete->execute(array($userNo));

		if(!$requete->fetchAll(PDO::FETCH_ASSOC))
		{
			$comment = trim($comment);

			$sql = 'insert into avis (numUser, avis, note, date, dateDernierVote) values(?, ?, ?, CURRENT_DATE(), null)';
			$requete = $this->dao->prepare($sql);
			$requete->execute(array($userNo, $comment, $mark));

			// Correspond à l'erreur du trigger : avisSansCommande
			return ($requete->errorCode() != '12000');
		}

		return false;
	}

	public function editAdvice($comment, $userNo, $mark)
	{
		$comment = trim($comment);

		$requete = $this->dao->prepare('update avis set avis = ?, note = ? where numUser = ?');
		$requete->execute(array($comment, $mark, $userNo));

		return $requete;
	}

	public function deleteAdvice($adviceNo)
	{
		$requete = $this->dao->prepare('delete from avis where numUser = ?');
		$requete->execute(array($numAvis));

		// Renvoit nb ligne effacé sinon une erreur
		return ($requete == 1);
	}

	public function hasVoted($adviceNo, $userNo)
	{
		$requete = $this->dao->prepare('select vote from vote where numAvis = ? and numUser = ?');
		$requete->execute(array($adviceNo, $userNo));

		if($requete->rowCount() > 0)
		{
			$data = $requete->fetch();
			return $data['vote'];
		}
		else
		{
			return -1;
		}
	}

	public function addVote($adviceNo, $vote, $userNo)
	{
		$requete = $this->dao->prepare('insert into vote(numAvis, numUser, vote) values(?, ?, ?)');
		$requete->execute(array($adviceNo, $userNo, $vote));

		switch($requete->errorCode())
		{
			case '11000' : // Correspond au trigger voteAvisSansCommentaire
			case '15000' : // Correspond au trigger voteSonAvis
				return false;
			case '13000' : // Correspond au trigger voteParAvisParUtilisateur
				return -1;
			default :
				return true;
		}
	}

	public function editVote($adviceNo, $vote, $userNo)
	{
		$requete = $this->dao->prepare('update vote set vote = ?  where numAvis = ? and numUser = ? ');
		$requete->execute(array($vote, $numAvis, $user ));

		return $requete;
	}

	public function deleteVote($adviceNo, $userNo)
	{
		$requete = $this->dao->prepare('delete from vote where numAvis = ? and numUser = ? ');
		$requete->execute(array($numAvis, $user));

		return $requete;
	}

	public function reportAdvice($adviceNo, $userNo, $remark)
	{
		// On teste si un signalement a déjà été fait
		$requete = $this->dao->prepare('select numAvis from signalavis where numUser = ? and numAvis = ?');
		$requete->execute(array($user, $numAvis));
		$doublon = $requete->fetchAll(\PDO::FETCH_ASSOC);

		if($doublon == false)
		{
			$remark = trim($remark);

			$requete = $this->dao->prepare('insert into signalavis(numAvis, numUser, remarque) values(?, ?, ?)');
			$requete->execute(array($numAvis, $user, $remarque));

			return true;
		}
		else {
			// L'utilisateur a déjà deposé un signalement sur cet avis
			return false;
		}
	}
}
