<?php

namespace DesignPattern\Wrong\Log;

class LogManager
{
    public function log(string $severity, string $mesage)
    {
        $logWritter = $this->createLogWritter();

        $today = new \DateTime();
        $formattedMessage = sprintf("[%s][%s]: %s", $today->format('d/m/Y'), $severity, $mesage);

        $logWritter->write($formattedMessage);

    }

    private function createLogWritter() : LogWritter
    {
        return new StdoutLogWritter();
    }
}