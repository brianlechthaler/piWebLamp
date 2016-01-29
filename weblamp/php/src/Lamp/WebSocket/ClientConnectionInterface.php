<?php

namespace Lamp\WebSocket;

interface ClientConnectionInterface
{
    public function getConnection();

    public function getName();

    public function setName($name);

    public function sendMsg($msg);
    
    public function send($data);
}
