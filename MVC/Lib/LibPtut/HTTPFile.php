<?php

namespace LibPtut;

class HTTPFile extends HTTPObject
{
    public function __construct()
    {
        $this->httpObject = isset($_FILE) ? $_FILE : null;
    }
}
