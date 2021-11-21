<?php

class baseCommand
{
    protected $discord;
    protected $event;

    public function __construct($event, $discord)
    {
        $this->discord = $discord;
        $this->event = $event;
    }

    protected function sendMessage($msg, $filePath = '')
    {
        $this->discord->setMessage($this->event->channelId(), $msg, $filePath);
    }

    protected function setRoles($groupId)
    {
        $this->discord->setRoles($this->event->guildId(), $this->event->userId(), $groupId);
    }

    protected function rmRoles($groupId)
    {
        $this->discord->rmRoles($this->event->guildId(), $this->event->userId(), $groupId);
    }
}