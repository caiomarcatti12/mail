<?php

namespace CaioMarcatti12\Logger;

use CaioMarcatti12\Core\Bean\Objects\BeanProxy;
use CaioMarcatti12\Core\Factory\InstanceFactory;
use CaioMarcatti12\Core\Launcher\Annotation\Launcher;
use CaioMarcatti12\Core\Launcher\Enum\LauncherPriorityEnum;
use CaioMarcatti12\Core\Launcher\Interfaces\LauncherInterface;
use CaioMarcatti12\Core\Modules\Modules;
use CaioMarcatti12\Core\Modules\ModulesEnum;
use CaioMarcatti12\Core\Validation\Assert;
use CaioMarcatti12\Env\Objects\Property;
use CaioMarcatti12\Mail\Adapter\MemoryAdapter;
use CaioMarcatti12\Mail\Interfaces\MailerInterface;

#[Launcher(LauncherPriorityEnum::BEFORE_LOAD_APPLICATION)]
class Loader implements LauncherInterface
{  
    public function handler(): void
    {
        if(Modules::isEnabled(ModulesEnum::MAIL)){
            if(Assert::equalsIgnoreCase(Property::get('application.env', 'test'), 'test')){
                BeanProxy::add(MailerInterface::class, MemoryAdapter::class);
            }

            InstanceFactory::createIfNotExists(Log::class);
        }
    }
}