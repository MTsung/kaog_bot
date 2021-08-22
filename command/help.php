<?php

class help implements command
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
        $this->discord->setEmbeds($this->event->channel_id(), kaog_bot_embeds::help());
    }
}