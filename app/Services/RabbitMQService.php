<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    private $connection;
    private $channel;
    private $exchange;
    private $exchangeType;

    public function __construct()
    {
        $config = config('rabbitmq');

        $this->exchange = $config['exchange'];
        $this->exchangeType = $config['exchange_type'];

        $this->connection = new AMQPStreamConnection(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password']
        );

        $this->channel = $this->connection->channel();
        $this->channel->exchange_declare($this->exchange, $this->exchangeType, false, true, false);
    }

    public function publish(string $routingKey, array $data): void
    {
        $msg = new AMQPMessage(json_encode($data, JSON_UNESCAPED_UNICODE), [
            'content_type' => 'application/json',
            'delivery_mode' => 2, // persistent
        ]);

        $this->channel->basic_publish($msg, $this->exchange, $routingKey);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
