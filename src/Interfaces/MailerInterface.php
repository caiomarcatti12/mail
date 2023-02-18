<?php

namespace CaioMarcatti12\Mail\Interfaces;

use CaioMarcatti12\Mail\Objects\Mail;
use CaioMarcatti12\Mail\Objects\SenderProperties;

interface MailerInterface
{
    public function configure(SenderProperties $senderProperties): void;
    public function send(Mail $mail): bool;
}