<?php

class jeff_chan implements command
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
        $this->discord->setMessage($this->event->channel_id(), '', APP_PATH.'cronjob/kaog_bot/file/jeff_chan.jpg');
    }
}