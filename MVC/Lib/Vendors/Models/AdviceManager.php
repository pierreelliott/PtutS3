<?php

namespace Models;

use \LibPtut\Manager;

abstract class AdviceManager extends Manager
{
    /**
	 * Méthode Permettant de récupérer l'avis d'un utilisateur
	 * @param $userNo int Le numéro de l'utilisateur
     * @return array Le commentaire, la note et la date de l'avis
	 */
	abstract public function getAdvice($userNo);

    /**
	 * Méthode permettant de récupérer tous les avis des utilisateurs
	 * @param $criterion string Le critère de tri des avis (en fonction de la date par défaut)
     * @param $order string L'ordre de tri (décroissant par défaut)
     * @return array La liste du commentaire, de la note et de la date pour chaque avis
	 */
	abstract public function getAllAdvices($criterion = 'date', $order = 'desc');

    /**
     * Méthode permettant de récupérer le nombre de votes positifs sur un avis
     * @param $adviceNo int Le numéro de l'avis
     * @return int le nombre de votes positifs
     */
    abstract public function getPositiveVotes($adviceNo);

    /**
     * Méthode permettant de récupérer le nombre de votes négatifs sur un avis
     * @param $adviceNo int Le numéro de l'avis
     * @return int le nombre de votes négatifs
     */
    abstract public function getNegativeVotes($adviceNo);

    /**
     * Méthode permettant d'ajouter un avis
     * @param $comment string Le commentaire l'avis de l'utilisateur
     * @param $userNo int L'identifiant de l'utilisateur
     * @param $mark int La note de l'avis l'utilisateur
     * @return boolval true si l'avis a été ajouté avec succès, false sinon
     */
    abstract public function addAdvice($comment, $userNo, $mark);

    /**
     * Méthode permettant de modifier un avis, si les valeurs ne sont pas modifiées on renvoie les valeurs déja présentes
     * @param $comment string Le commentaire l'avis de l'utilisateur
     * @param $userNo int L'identifiant de l'utilisateur
     * @param $mark int La note de l'avis l'utilisateur
     * @return array Le résultat de la requête
     */
    abstract public function editAdvice($comment, $userNo, $mark);

    /**
     * Méthode permettant de supprimer un avis (seulement pour les admins)
     * @param $adviceNo int L'identifiant de l'avis
     * @return boolval true en cas de succès, false sinon
     */
    abstract public function deleteAdvice($adviceNo);

    /**
     * Méthode testant que l'utilisateur a déjà voté pour un avis
     * @param $adviceNo int L'identifiant de l'avis
     * @param $userNo int L'identifiant de l'utilisateur
     * @return mixed La valeur du vote s'il en a déjà un, -1 sinon
     */
    abstract public function hasVoted($adviceNo, $userNo);

    /**
     * Méthode permettant d'ajouter un avis
     * @param $adviceNo int L'identifiant de l'avis
     * @param $vote int La nature du vote (positif ou négatif)
     * @param $userNo int L'identifiant de l'utilisateur
     * @return mixed true en cas de succès, false ou -1 sinon
     */
    abstract public function addVote($adviceNo, $vote, $userNo);

    /**
     * Méthode permettant de modifier un avis
     * @param $adviceNo int L'identifiant de l'avis
     * @param $vote int La nature du nouveau vote (positif ou négatif)
     * @param $userNo int L'identifiant de l'utilisateur
     * @return array Le résultat de la requête
     */
    abstract public function editVote($adviceNo, $vote, $userNo);

    /**
     * Méthode permettant de supprimer un avis
     * @param $adviceNo int L'identifiant de l'avis
     * @param $userNo int L'identifiant de l'utilisateur
     * @return array Le résultat de la requête
     */
    abstract public function deleteVote($adviceNo, $userNo);

    /**
     * Méthode permettant de signaler un avis
     * @param $adviceNo int L'identifiant de l'avis
     * @param $userNo int L'identifiant de l'utilisateur qui signale
     * @param $remark string Le commentaire du signalement
     * @return boolval true en cas de succès, false sinon
     */
    abstract public function reportAdvice($adviceNo, $userNo, $remark);

	/**
     * Méthode permettant de récupérer tous les avis signalés
     * @return array Un tableau avec tous les avis signalés
     */
    abstract public function getAllReportedAdvices();

	/**
	 * Méthode modifiant le commentaire d'un avis
	 * @param $adviceNo int L'identifiant de l'avis
	 * @param string Le nouveau commentaire
	 */
	abstract public function editComment($adviceNo, $comment);

	/**
	 * Méthode supprimant les signalements d'un avis
	 * @param $adviceNo int L'identifiant de l'avis
	 */
	abstract public function deleteComment($adviceNo);

	/**
	 * Méthode supprimant les signalements d'un avis
	 * @param $adviceNo int L'identifiant de l'avis
	 */
	abstract public function deleteReports($adviceNo);

	/**
	 * Méthode récupérant tous les signalements d'un avis
	 * @param $adviceNo int L'identifiant de l'avis
	 * @return array Un tableau contenant tous les signalements de l'avis
	 */
	abstract public function getReports($adviceNo);
 }
