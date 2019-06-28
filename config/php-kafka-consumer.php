<?php

return [
    'topic' => env('KAFKA_TOPIC'),
    'broker' => env('KAFKA_BROKERS'),
    'groupId' => env('GROUP_ID'),
    'securityProtocol' => env('SECURITY_PROTOCOL'),
    'sasl' => [
        'mechanisms' => env('SASL_MECHANISMS'),
        'username' => env('SASL_USERNAME'),
        'password' => env('SASL_PASSWORD'),
    ],
];
