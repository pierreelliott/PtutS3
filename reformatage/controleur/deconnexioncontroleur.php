<?php
    session_start();

    // Suppression des variables de session et de la session
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique
    #setcookie("pseudo", "");
    #setcookie("mdpHash", "");
	
	unset($_COOKIE["pseudo"]);
	unset($_COOKIE["mdpHash"]);

    header("Location: index.php");