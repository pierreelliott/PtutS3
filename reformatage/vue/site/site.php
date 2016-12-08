<?php

	require_once("head.php");
	require_once("body.php");

	function afficherSite($page)
	{
		echo '<!DOCTYPE html>
		<html lang="fr">';
		
		afficherHead();
		
		afficherBody($page);
		
		echo '</html>';
	}

?>