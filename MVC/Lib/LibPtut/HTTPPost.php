<?php

namespace LibPtut;

class HTTPPost extends HTTPObject
{
    public function __construct()
    {
        $this->httpObject = $_POST;
    }
}
