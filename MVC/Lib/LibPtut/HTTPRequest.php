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

        $this->query = new HTTPGet;
        $this->request = new HTTPPost;
        $this->cookies = new HTTPCookie;
        $this->files = new HTTPFile;
        $this->server = new HTTPServer;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function isXmlHttpRequest()
    {
        return $this->server->get('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest';
    }
}
