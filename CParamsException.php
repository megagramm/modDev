<?php

final class CParamsException extends Exception
{
    public function __construct(string $message, $code = 1, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
