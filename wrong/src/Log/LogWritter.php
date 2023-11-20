<?php

namespace DesignPattern\Wrong\Log;

interface LogWritter
{
    public function write(string $formattedMessage) : void;
}