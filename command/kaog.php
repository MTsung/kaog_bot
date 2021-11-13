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
        $kago_text = include(APP_PATH.'cronjob/kaog_bot/text/kaog.php');
        $key = rand(0, count($kago_text) - 1);
        $this->discord->setMessage($this->event->channelId(), $kago_text[$key]['message'], $kago_text[$key]['file']);
    }
}