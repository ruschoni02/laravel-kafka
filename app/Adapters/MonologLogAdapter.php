<?php

namespace App\Adapters;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

class MonologLogAdapter
{
    private $logger;

    public function __construct()
    {
        $handler = new StreamHandler("php://stdout");
        $handler->setFormatter(new JsonFormatter());
        $this->logger = new Logger('laravel-kafka');
        $this->logger->pushHandler($handler);
        $this->logger->pushProcessor(function ($record) {
            $record['datetime'] = $record['datetime']->format('c');
            return $record;
        });
    }

    public function error(string $message, array $context = []): bool
    {
        return $this->logger->addError($message, $context);
    }

    public function info(string $message, array $context = []): bool
    {
        return $this->logger->addInfo($message, $context);
    }
}
