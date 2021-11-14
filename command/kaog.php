<?php

class kaog implements command
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
        $text = include(KAOG_BOT_PATH.'text/kaog.php');
        $key = rand(0, count($text) - 1);
        $this->discord->setMessage($this->event->channelId(), $text[$key]['message'], $text[$key]['file']);
    }
}