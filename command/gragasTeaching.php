<?php

class gragasTeaching implements command
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
        $this->discord->setMessage($this->event->channelId(), '', APP_PATH.'cronjob/kaog_bot/file/酒桶教學.mp4');
    }
}