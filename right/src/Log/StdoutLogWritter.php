<?php

namespace DesignPattern\Right\Log;

class StdoutLogWritter implements LogWritter
{

    public function write(string $formattedMessage): void
    {
        fwrite(STDOUT, $formattedMessage);
    }
}