<?php

namespace CaioMarcatti12\Mail\Objects;

use CaioMarcatti12\Core\Validation\Assert;
use CaioMarcatti12\Mail\Adapter\InvalidMailException;

class Mail
{
    private ?Address $reply = null;
    private ?AddressList $addressList = null;
    private ?AddressList $copyList = null;
    private ?AttachmentList $attachmentList = null;

    private string $subject = '';
    private string $altBody = '';
    private string $body = '';

    public function __construct(string $body, string $subject, AddressList $addressList)
    {
        $this->addressList = new AddressList();
        $this->copyList = new AddressList();
        $this->attachmentList = new AttachmentList();

        if(Assert::isEmpty($body)) throw new InvalidMailException('body');
        if(Assert::isEmpty($subject)) throw new InvalidMailException('subject');
        if(Assert::isEmpty($addressList)) throw new InvalidMailException('addressList');
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAltBody(): string
    {
        return $this->altBody;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getAttachmentList(): ?AttachmentList
    {
        return $this->attachmentList;
    }

    public function getCopyList(): ?AddressList
    {
        return $this->copyList;
    }

    public function getAddressList(): ?AddressList
    {
        return $this->addressList;
    }
    
    public function setReply(?Address $reply): self
    {
        $this->reply = $reply;

        return $this;
    }

    public function getReply(): ?Address
    {
        return $this->reply;
    }

    public function addAddress(Address $address): self
    {
        $this->addressList->append($address);

        return $this;
    }
    
    public function addCopy(Address $address): self
    {
        $this->copyList->append($address);

        return $this;
    }
    
    public function addAttachment(Attachment $attachment): self
    {
        $this->attachmentList->append($attachment);

        return $this;
    }

}