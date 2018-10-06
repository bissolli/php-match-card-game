<?php

namespace Bissolli\CardGame\Exceptions;

class NotEnoughPlayersException extends \Exception
{
    public function __construct($message, $code = 422, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
