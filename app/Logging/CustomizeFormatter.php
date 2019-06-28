<?php

namespace App\Logging;

use Monolog\Formatter\JsonFormatter;

class CustomizeFormatter
{
    public function __invoke($monolog)
    {
        $jsonFormatter = new JsonFormatter();
        foreach ($monolog->getHandlers() as $handler) {
            $handler->setFormatter($jsonFormatter);
        }
        $monolog->pushProcessor(function ($record) {
            $record['datetime'] = $record['datetime']->format('c');
            return $record;
        });
    }
}