<?php

namespace LibPtut;

class Controller extends ApplicationComponent
{
    protected $action = '';
    protected $module = '';
	protected $managers = null;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);

        $config = $this->app->getConfig();
        $host = $config->get('dbhost');
        $dbname = $config->get('dbname');
        $user = $config->get('dbuser');
        $pwd = $config->get('dbpwd');

        $this->managers = new Managers('PDO', PDOFactory::getMySqlConnection($host, $dbname, $user, $pwd));

        $this->setModule($module);
        $this->setAction($action);
    }

    public function execute(HTTPRequest $request)
    {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
        }

        return $this->$method($request);
    }

    public function setModule($module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
        }

        $this->module = $module;
    }

    public function setAction($action)
    {
        if (!is_string($action) || empty($action))
        {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
        }

        $this->action = $action;
    }

    public function renderView($view = null, array $vars = array(), array $scripts = array())
    {
        if($view == null || !is_string($view))
        {
            $view = $this->action;
        }

        $contentFile = __DIR__.'/../../App/'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$view.'.php';

        if(!file_exists($contentFile))
        {
            throw new \RuntimeException('La vue '.$contentFile.' n\'existe pas');
        }

        $user = $this->app->getUser();

        extract($vars);

        ob_start();
            require($contentFile);
        $content = ob_get_clean();

        ob_start();
            foreach($scripts as $script)
            {
                echo '<script src="js/'.$script.'"></script>'.PHP_EOL;
            }
        $scripts = ob_get_clean();

        ob_start();
            require(__DIR__.'/../../Web/layout/layout.php');
        $responseContent = ob_get_clean();

        return new HTTPResponse($responseContent);
    }
}
