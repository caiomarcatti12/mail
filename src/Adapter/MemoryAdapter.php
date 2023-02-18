<?php

namespace CaioMarcatti12\Mail\Adapter;

use CaioMarcatti12\Mail\Interfaces\MailerInterface;
use CaioMarcatti12\Mail\Objects\Mail;
use CaioMarcatti12\Mail\Objects\SenderProperties;

class MemoryAdapter implements MailerInterface
{
    private ?SenderProperties $senderProperties;
    
    public function configure(SenderProperties $senderProperties): void{
        $this->senderProperties = $senderProperties;
    }

    public function send(Mail $mail): bool{
        return true;
    }
}