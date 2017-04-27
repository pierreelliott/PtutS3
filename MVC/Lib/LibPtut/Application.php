<?php

namespace LibPtut;

abstract class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
	protected $user;
	protected $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->name = '';
		$this->user = new User;
		$this->config = new Config($this);
    }

    abstract public function run();

    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function getName()
    {
        return $this->name;
    }

	public function getUser()
	{
		return $this->user;
	}

	public function getConfig()
	{
		return $this->config;
	}

    public function getController()
	{
		$router = new Router;

		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../../App/'.$this->name.'/Config/routes.xml');

		$routes = $xml->getElementsByTagName('route');

		// On parcourt les routes du fichier XML.
		foreach ($routes as $route)
		{
			$vars = [];

			// On regarde si des variables sont présentes dans l'URL.
			if ($route->hasAttribute('params'))
			{
				$vars = explode(',', $route->getAttribute('params'));
			}

			// On ajoute la route au routeur.
			$router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
		}

		try
		{
			// On récupère la route correspondante à l'URL.
			$matchedRoute = $router->getRoute($this->httpRequest->getRequestURI());
		}
		catch (\RuntimeException $e)
		{
			if ($e->getCode() == Router::NO_ROUTE)
			{
				// Si aucune route ne correspond, c'est que la page demandée n'existe pas.
				$this->httpResponse->redirect404();
			}
		}

		// On ajoute les variables de l'URL au tableau $_GET.
		$_GET = array_merge($_GET, $matchedRoute->getVars());

		// On instancie le contrôleur.
		$controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
		return new $controllerClass($this, $matchedRoute->getModule(), $matchedRoute->getAction());
	}
}
