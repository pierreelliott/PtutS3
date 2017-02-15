<?php
	session_start();
	/* Son but rediriger en fonction de la page où l'on se trouve vers le bon controleur */


	# On crée un formulaire invisible pour demander l'appel d'une page

	$uri = trim($_SERVER["REQUEST_URI"]);

	$xml = new \DOMDocument;
	$xml->load("config/routes.xml");
	$routes = $xml->getElementsByTagName("route");
	$routeTrouvee = false;

	foreach($routes as $route)
	{
		if(preg_match("#^".$route->getAttribute("url")."([?&]+([^=&]+)=?([^&]*)?)*$#", $uri, $matchedUrl))
		{
			$routeTrouvee = true;

			if($route->hasAttribute("params"))
			{
				$params = explode(",", $route->getAttribute("params"));
				$listParams = [];

				foreach ($matchedUrl as $key => $value)
		        {
					if ($key !== 0)
					{
						$listParams[$params[$key - 1]] = $value;
					}
		        }

				$_GET = array_merge($_GET, $listParams);
			}

			if($route->hasAttribute("controleur"))
			{
				$controleurClass = $route->getAttribute("controleur")."Controleur";
				$methode = $route->getAttribute("methode");

				include_once($controleurClass.".php");
				$controleur = new $controleurClass;
				$controleur->$methode();
			}
			else
			{
				$vue = $route->getAttribute("vue");
				include_once("vue/".$vue.".php");
			}
		}
	}

	if(!$routeTrouvee)
	{
		header("Location: /404");
	}

?>
