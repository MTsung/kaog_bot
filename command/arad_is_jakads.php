<?php

class arad_is_jakads implements command
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
        $this->discord->setMessage($this->event->channel_id(), '', APP_PATH.'cronjob/kaog_bot/file/Arad.jpg');
    }
}