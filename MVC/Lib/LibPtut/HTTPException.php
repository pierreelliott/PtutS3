<?php

namespace LibPtut;

class HTTPException extends \RuntimeException
{
    private $statusCode;

    public function __construct($statusCode, $message = '', $code = 0 , \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }
}
