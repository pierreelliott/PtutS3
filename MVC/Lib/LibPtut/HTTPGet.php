<?php

namespace LibPtut;

class HTTPGet extends HTTPObject
{
    public function __construct()
    {
        $this->httpObject = $_GET;
    }
}
