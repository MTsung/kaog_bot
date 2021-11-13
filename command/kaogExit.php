<?php

class kaogExit implements command
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
        if ($this->event->userId() == ADMIN_ID) {
            $this->discord->setMessage($this->event->channelId(), 'bye');
            error_log('kaog_bot2 bye.');
            exit;
        }
        $this->discord->setMessage($this->event->channelId(), ':question:');
    }
}