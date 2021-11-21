<?php

class help extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->discord->setEmbeds($this->event->channelId(), kaogBotEmbeds::help());
    }
}