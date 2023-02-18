<?php

namespace CaioMarcatti12\Mail\Objects;

class SenderProperties
{
    private string $host = '';
    private bool $smtpAuth = false;
    private bool $encryptionTls = false;
    private string $name = '';
    private string $username = '';
    private string $password = '';
    private int $port = 1025;
    
    public function __construct(string $host = '',
        bool $smtpAuth = false,
        bool $encryptionTls = false,
        string $name = '',
        string $username = '',
        string $password = '',
        int $port = 1025
    )
    {
        $this->host = $host;
        $this->smtpAuth = $smtpAuth;
        $this->encryptionTls = $encryptionTls;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }

    /**
     * Get the value of host
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @param string $host
     *
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the value of smtpAuth
     *
     * @return bool
     */
    public function getSmtpAuth(): bool
    {
        return $this->smtpAuth;
    }

    /**
     * Set the value of smtpAuth
     *
     * @param bool $smtpAuth
     *
     * @return self
     */
    public function setSmtpAuth(bool $smtpAuth): self
    {
        $this->smtpAuth = $smtpAuth;

        return $this;
    }

    /**
     * Get the value of encryptionTls
     *
     * @return bool
     */
    public function getEncryptionTls(): bool
    {
        return $this->encryptionTls;
    }

    /**
     * Set the value of encryptionTls
     *
     * @param bool $encryptionTls
     *
     * @return self
     */
    public function setEncryptionTls(bool $encryptionTls): self
    {
        $this->encryptionTls = $encryptionTls;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of port
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Set the value of port
     *
     * @param int $port
     *
     * @return self
     */
    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }
}