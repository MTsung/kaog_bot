<?php

class nijuu implements command
{
    private $discord;
    private $event;

    public function __construct($event, $discord)
    {
        $this->discord = $discord;
        $this->event = $event;
    }

    public function run()
    {
        $this->discord->setMessage($this->event->channelId(), 'https://youtu.be/S9lVCA2xv40');
    }
}