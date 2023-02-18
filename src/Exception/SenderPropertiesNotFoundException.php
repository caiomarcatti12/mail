<?php

namespace CaioMarcatti12\Mail\Adapter;

use Exception;

final class SenderPropertiesNotFoundException extends Exception
{
    public function __construct(string $field)
    {
        parent::__construct('Sender configuration not filled in correctly, field: '.$field, 500, null);
    }
}