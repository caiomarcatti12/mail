<?php

namespace CaioMarcatti12\Mail\Objects;

class Attachment
{
    private string $file;
    private string $name;

    /**
     * @param string $file
     * @param string $name
     */
    public function __construct(string $file, string $name)
    {
        $this->file = $file;
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}