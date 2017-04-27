<?php

namespace LibPtut;

class Controller extends ApplicationComponent
{
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';
	protected $managers = null;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);

		$host = $this->app->getConfig()->get('dbhost');
		$dbname = $this->app->getConfig()->get('dbname');
		$user = $this->app->getConfig()->get('dbuser');
		$pwd = $this->app->getConfig()->get('dbpwd');

		$this->managers = new Managers('PDO', PDOFactory::getMySqlConnection($host, $dbname, $user, $pwd));
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute()
    {
        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
        }

        $this->$method($this->app->getHttpRequest());
    }

    public function getPage()
    {
        return $this->page;
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

    public function setView($view)
    {
        if (!is_string($view) || empty($view))
        {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }

        $this->view = $view;
        $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
    }
}
