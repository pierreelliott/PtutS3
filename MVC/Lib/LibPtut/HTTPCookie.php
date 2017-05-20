<?php

namespace LibPtut;

class HTTPCookie extends HTTPObject
{
    public function __construct()
    {
        $this->httpObject = $_COOKIE;
    }
}
