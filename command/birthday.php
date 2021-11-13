<?php

class birthday implements command
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
        $this->discord->setRoles($this->event->guildId(), $this->event->userId(), "853479295568838706");
    }
}