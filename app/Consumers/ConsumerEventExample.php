<?php

namespace App\Consumers;

use App\Adapters\MonologLogAdapter;
use Kafka\Consumer\Contracts\Consumer;

class ConsumerEventExample extends Consumer
{
    private $logger;

    public function __construct()
    {
        $this->logger = new MonologLogAdapter();
    }

    public function handle(string $message): void
    {
        $this->logger->info('Event consumed', [
            'event' => json_decode($message),
        ]);
    }
}
