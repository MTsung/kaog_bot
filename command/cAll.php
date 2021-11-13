<?php

class cAll implements command
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
        $message = $this->event->cococola()->getData('order by RAND() limit 1')[0]['content'];
        $this->discord->setMessage($this->event->channelId(), htmlspecialchars_decode($message, ENT_QUOTES));
    }
}