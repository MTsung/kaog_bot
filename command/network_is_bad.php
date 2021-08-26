<?php

class network_is_bad implements command
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
        $this->discord->setMessage($this->event->channel_id(), '', APP_PATH.'cronjob/kaog_bot/file/網路很差.mp3');
    }
}