<?php

namespace CaioMarcatti12\Mail\Objects;

use InvalidArgumentException;

class AttachmentList extends \ArrayObject
{
    public function getIteratorClass(): string
    {
        return Attachment::class;
    }

    public function append(mixed $value): void
    {
        if(!$value instanceof Attachment) throw new InvalidArgumentException();

        parent::append($value);
    }
}