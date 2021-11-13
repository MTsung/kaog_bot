<?php

class cut implements command
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
        $this->discord->setRoles($this->event->guildId(), $this->event->userId(), '799627678700273664');
        $this->discord->rmRoles($this->event->guildId(), $this->event->userId(), '483324065369554976');
    }
}