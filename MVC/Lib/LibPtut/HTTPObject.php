<?php

namespace LibPtut;

class HTTPObject
{
    protected $httpObject;

    public function __construct(array $httpObject)
    {
        $this->httpObject = $httpObject;
    }

    public function get($key, $default = null)
    {
        return isset($this->httpObject[$key]) ? $this->httpObject[$key] : $default;
    }

    public function has($key)
    {
        return isset($this->httpObject[$key]);
    }

    public function remove($key)
    {
        unset($this->httpObject[$key]);
    }

    public function count()
    {
        return count($this->httpObject[$key]);
    }
}
