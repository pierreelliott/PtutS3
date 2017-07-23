<?php

namespace LibPtut;

class HTTPResponse
{
    private $content;

    public function __construct($content = '')
    {
        if(!is_string($content))
        {
            throw new \InvalidArgumentException('Le contenu doit être une chaîne de caractères valide');
        }

        $this->content = $content;
    }

    public static function create($content = '')
    {
        return new static($content);
    }

    public function addHeader($header)
    {
        header($header);
    }

    public function redirect($location)
    {
        header('Location: '.$location);
        exit;
    }

    public function send()
    {
        exit($this->content);
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
}
