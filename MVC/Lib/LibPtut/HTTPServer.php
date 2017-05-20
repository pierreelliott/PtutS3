<?php

namespace LibPtut;

class HTTPServer extends HTTPObject
{
    public function __construct()
    {
        $this->httpObject = $_SERVER;
    }
}
