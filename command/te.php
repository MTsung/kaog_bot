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
        $this->discord->setMessage($this->event->channelId(), '雷中之雷 貫中貫己 
姆中網中 清口聽聽', KAOG_BOT_PATH.'file/ter.png');
    }
}