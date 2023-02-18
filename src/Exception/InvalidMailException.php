<?php

namespace CaioMarcatti12\Mail\Adapter;

use Exception;

final class InvalidMailException extends Exception
{
    public function __construct(string $field)
    {
        parent::__construct('The format of the mail object is not valid, field: '.$field, 500, null);
    }
}