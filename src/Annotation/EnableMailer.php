<?php

namespace CaioMarcatti12\Mail\Annotation;

use Attribute;
use CaioMarcatti12\Core\Modules\Modules;
use CaioMarcatti12\Core\Modules\ModulesEnum;
use CaioMarcatti12\Mail\Adapter\PhpMailerAdapter;

#[Attribute(Attribute::TARGET_CLASS)]
class EnableMailer
{
    private string $adapter = '';

    public function __construct(string $adapter = PhpMailerAdapter::class)
    {
        Modules::enable(ModulesEnum::MAIL);
        $this->adapter = $adapter;
    }

    public function getAdapter(): string
    {
        return $this->adapter;
    }
}