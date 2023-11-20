<?php

namespace DesignPattern\Right\Log;

class StdoutLogManager extends LogManager
{
    protected function createLogWritter(): LogWritter
    {
        return new StdoutLogWritter();
    }
}