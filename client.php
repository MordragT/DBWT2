<?php
$client = new \Bloatless\WebSocket\Client;
$client->connect('127.0.0.1', 8000, '/demo');
$client->sendData(json_encode([
            'action' => 'echo',
            'data' => 'Hallo Welt!']
    )
);
