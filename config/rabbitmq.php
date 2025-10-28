<?php

return [
    'host' => env('RABBITMQ_HOST', '127.0.0.1'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'guest'),
    'password' => env('RABBITMQ_PASS', 'guest'),
    'exchange' => env('RABBITMQ_EXCHANGE', 'parking.events'),
    'exchange_type' => env('RABBITMQ_EXCHANGE_TYPE', 'topic'),
    'routing_key' => env('RABBITMQ_ROUTING_KEY', 'tariff.updated'),
];
