<?php

namespace App\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Handle a new WebSocket connection
        $this->clients->attach($conn);
        echo "New client connected" . PHP_EOL;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Handle a received WebSocket message
        $data = json_decode($msg, true);
        $this->broadcastMessage($data);
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Handle a WebSocket connection closing
        $this->clients->detach($conn);
        echo "Client disconnected" . PHP_EOL;
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Handle WebSocket errors
        echo "Error: {$e->getMessage()}" . PHP_EOL;
    }

    protected function broadcastMessage($data)
    {
        foreach ($this->clients as $client) {
            $client->send(json_encode($data));
        }
    }
}
