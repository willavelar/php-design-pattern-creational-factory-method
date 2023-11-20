<?php

namespace DesignPattern\Wrong\Log;

class StdoutLogWritter implements LogWritter
{
    public function write(string $formattedMessage): void
    {
        fwrite(STDOUT, $formattedMessage);
    }
}