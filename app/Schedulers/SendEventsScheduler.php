<?php

namespace App\Schedulers;

use App\Adapters\MonologLogAdapter;
use Arquivei\Events\Sender\Sender;
use Arquivei\Events\Sender\Message;
use Arquivei\Events\Sender\Exporters\Kafka;

class SendEventsScheduler
{
    private $logger;
    private $sender;

    public function __construct()
    {
        $this->logger = new MonologLogAdapter();
        $this->sender = new Sender(new Kafka([
            'group_id' => env('GROUP_ID'),
            'kafka_brokers' => env('KAFKA_BROKERS'),
            'security_protocol' => env('SECURITY_PROTOCOL'),
            'sasl_mechanisms' => env('SASL_MECHANISMS'),
            'sasl_username' => env('SASL_USERNAME'),
            'sasl_password' => env('SASL_PASSWORD'),
        ]));
    }

    public function execute(): void
    {
        $event = 1;
        while (true) {

            $this->publishMessage($event);
            $event++;

            if (($event % 10000) == 0) {
                $this->logger->info('Waiting...');
                sleep(1);
            }
        }
    }

    private function publishMessage(int $eventId): void
    {
        $message = new Message(
            'laravel-kafka',
            'test-event',
            1,
            [
                'EventId' => $eventId,
            ],
            false
        );

        $this->sender->push($message, 'laravel-kafka-ruschoni');
    }
}
