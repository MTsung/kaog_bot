<?php

class roll implements command
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
        $rand = rand(0, 100);
        $this->discord->setMessage($this->event->channel_id(), $rand);
    }
}