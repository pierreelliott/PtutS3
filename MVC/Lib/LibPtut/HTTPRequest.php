<?php

namespace LibPtut;

class HTTPRequest extends ApplicationComponent
{
    public $query;
    public $request;
    public $cookies;
    public $files;
    public $server;

    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->query = new HTTPObject($_GET);
        $this->request = new HTTPObject($_POST);
        $this->cookies = new HTTPObject($_COOKIE);
        $this->files = new HTTPObject(isset($_FILE) ? $_FILE : array());
        $this->server = new HTTPObject($_SERVER);
    }

    public function getMethod()
    {
        return $this->server->get('REQUEST_METHOD');
    }

    public function getRequestURI()
    {
        return $this->server->get('REQUEST_URI');
    }

    public function isXmlHttpRequest()
    {
        return $this->server->get('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest';
    }
}
