<?php

class kaog_exit implements command
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
        if ($this->event->user_id() == ADMIN_ID) {
            $this->discord->setMessage($this->event->channel_id(), 'bye');
            error_log('kaog_bot2 bye.');
            exit;
        }
        $this->discord->setMessage($this->event->channel_id(), ':question:');
    }
}