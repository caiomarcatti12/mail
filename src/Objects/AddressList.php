<?php

namespace CaioMarcatti12\Mail\Objects;

use InvalidArgumentException;

class AddressList extends \ArrayObject
{
    public function getIteratorClass(): string
    {
        return Address::class;
    }

    public function append(mixed $value): void
    {
        if(!$value instanceof Address) throw new InvalidArgumentException();

        parent::append($value);
    }
}