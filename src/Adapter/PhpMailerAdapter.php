<?php

namespace CaioMarcatti12\Mail\Adapter;

use CaioMarcatti12\Core\Validation\Assert;
use CaioMarcatti12\Env\Objects\Property;
use CaioMarcatti12\Mail\Exception\SenderPropertiesNotFoundException;
use CaioMarcatti12\Mail\Interfaces\MailerInterface;
use CaioMarcatti12\Mail\Objects\Mail;
use CaioMarcatti12\Mail\Objects\SenderProperties;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerAdapter implements MailerInterface
{
    private ?SenderProperties $senderProperties;
    
    public function __construct()
    {
        $this->senderProperties = new SenderProperties(
            Property::get('mail.host', 'host.docker.internal'),
            Property::get('mail.smtpAuth', false),
            Property::get('mail.encryptionTls', false),
            Property::get('mail.name', 'sender'),
            Property::get('mail.username', ''),
            Property::get('mail.password', ''),
            Property::get('mail.port', 1025),
        );   
    }
    
    public function configure(SenderProperties $senderProperties): void{
        $this->senderProperties = $senderProperties;
    }
    
    public function send(Mail $mail): bool{
        $this->validateSenderProperties();
        
        $phpmailer = new PHPMailer(true);
        $phpmailer->isSMTP();                                          
        $phpmailer->Host       = $this->senderProperties->getHost();
        $phpmailer->SMTPAuth   = $this->senderProperties->getSmtpAuth();
        $phpmailer->Username   = $this->senderProperties->getUsername();
        $phpmailer->Password   =  $this->senderProperties->getPassword();
                                     
        $phpmailer->SMTPSecure = $this->senderProperties->getEncryptionTls();           //Enable implicit TLS encryption
        $phpmailer->SMTPAutoTLS = $this->senderProperties->getEncryptionTls();           //Enable implicit TLS encryption
        
        $phpmailer->Port       = $this->senderProperties->getPort();

        $phpmailer->setFrom($this->senderProperties->getUsername(), $this->senderProperties->getName());
        
        /** @var Address $address */
        foreach($mail->getAddressList() as $address){
            $phpmailer->addAddress($address->getEmail(), $address->getName());
        }
        
        /** @var Address $address */
        foreach($mail->getCopyList() as $address){
            $phpmailer->addCC($address->getEmail(), $address->getName());
        }
        
        if(Assert::isNotEmpty($mail->getReply())){
            $phpmailer->addReplyTo($mail->getReply()->getEmail(), $mail->getReply()->getName());
        }
        
        $phpmailer->isHTML(true);
        $phpmailer->Subject = $mail->getSubject();
        $phpmailer->Body    = $mail->getBody();
        $phpmailer->AltBody = $mail->getAltBody();

        $phpmailer->send();

        return true;
    }

    private function validateSenderProperties(): void{
        if(Assert::isEmpty($this->senderProperties)) throw new SenderPropertiesNotFoundException('all');
    }
}
