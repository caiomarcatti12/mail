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
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                          
        $mail->Host       = $this->senderProperties->getHost();
        $mail->SMTPAuth   = $this->senderProperties->getSmtpAuth();
        $mail->Username   = $this->senderProperties->getUsername();
        $mail->Password   = $this->senderProperties->getPassword();
                                     
        $mail->SMTPSecure = $this->senderProperties->getEncryptionTls();           //Enable implicit TLS encryption
        
        $mail->Port       = $this->senderProperties->getPort();

        $mail->setFrom($this->senderProperties->getUsername(), $this->senderProperties->getName());
        
        /** @var Address $address */
        foreach($mail->getAddressList() as $address){
            $mail->addAddress($address->getEmail(), $address->getName());
        }
        
        /** @var Address $address */
        foreach($mail->getCopyList() as $address){
            $mail->addCC($address->getEmail(), $address->getName());
        }
        
        if(Assert::isNotEmpty($mail->getReply())){
            $mail->addReplyTo($mail->getReply()->getEmail(), $mail->getReply()->getName());
        }
        
        $mail->isHTML(true);
        $mail->Subject = $mail->getSubject();
        $mail->Body    = $mail->getBody();
        $mail->AltBody = $mail->getAltBody()
        ;

        $mail->send();

        return true;
    }

    private function validateSenderProperties(): void{
        if(Assert::isEmpty($this->senderProperties)) throw new SenderPropertiesNotFoundException('all');
    }
}
