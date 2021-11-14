<?php

class sleep implements command
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
        $sleep_text = include(KAOG_BOT_PATH.'text/sleep.php');
        $key = rand(0, count($sleep_text) - 1);
        $this->discord->setMessage($this->event->channelId(), $sleep_text[$key]['message'], $sleep_text[$key]['file']);
    }
}