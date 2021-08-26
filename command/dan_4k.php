<?php

class dan_4k implements command
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
        $this->discord->setMessage($this->event->channel_id(), 'https://sites.google.com/view/danreform/home');
    }
}