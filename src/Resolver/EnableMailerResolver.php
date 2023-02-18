<?php

namespace CaioMarcatti12\Mail\Resolver;

use CaioMarcatti12\Core\Bean\Annotation\AnnotationResolver;
use CaioMarcatti12\Core\Bean\Interfaces\ClassResolverInterface;
use CaioMarcatti12\Core\Bean\Objects\BeanProxy;
use CaioMarcatti12\Mail\Annotation\EnableMailer;
use CaioMarcatti12\Mail\Interfaces\MailerInterface;
use ReflectionClass;

#[AnnotationResolver(EnableMailer::class)]
class EnableMailerResolver implements ClassResolverInterface
{
    public function handler(object &$instance): void
    {
        $reflectionClass = new ReflectionClass($instance);

        $attributes = $reflectionClass->getAttributes(EnableMailer::class);

        /** @var EnableLog $attribute */
        $attribute = ($attributes[0]->newInstance());

        BeanProxy::add(MailerInterface::class, $attribute->getAdapter());
    }
}