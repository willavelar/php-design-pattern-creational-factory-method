<?php

namespace DesignPattern\Wrong\Log;

class FileLogWritter implements LogWritter
{
    private $file;
    public function __construct(string $pathFile)
    {
        $this->file = fopen($pathFile, 'a+');
    }

    public function write(string $formattedMessage): void
    {
        fwrite($this->file, $formattedMessage);
    }

    public function __destruct()
    {
        fclose($this->file);
    }
}