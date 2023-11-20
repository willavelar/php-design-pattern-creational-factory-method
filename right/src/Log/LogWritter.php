<?php

namespace DesignPattern\Right\Log;

interface LogWritter
{
    public function write(string $formattedMessage) : void;
}