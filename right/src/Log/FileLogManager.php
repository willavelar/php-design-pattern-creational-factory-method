<?php

namespace DesignPattern\Right\Log;

class FileLogManager extends LogManager
{
    private string $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    protected function createLogWritter(): LogWritter
    {
        return new FileLogWritter($this->filePath);
    }
}