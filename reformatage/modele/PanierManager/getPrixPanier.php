<?php

	public function getPrixPanier()
	{
		$resultat = sum($_SESSION["panier"]["prix"]);
		return $resultat;
	}