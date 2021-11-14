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
        $this->discord->setMessage($this->event->channelId(), '', KAOG_BOT_PATH.'file/酒桶教學.mp4');
    }
}