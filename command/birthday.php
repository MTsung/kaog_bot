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
        $temp = $this->event->discordUser()->getData('where user_id=?', [$this->event->userId()])[0];
        $this->event->discordUser()->setData([
            'id' => $temp['id'],
            'is_birthday_group' => 1,
        ]);
    }
}