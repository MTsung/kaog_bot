<?php

class te implements command
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
        $this->discord->setMessage($this->event->channel_id(), '雷中之雷 貫中貫己 
姆中網中 清口聽聽', APP_PATH.'cronjob/kaog_bot/file/ter.png');
    }
}