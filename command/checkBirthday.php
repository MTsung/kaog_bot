<?php

class checkBirthday implements command
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
        $temp = $this->event->discordUser()->getData('where user_id=?', [$this->event->userId()])[0];
        if ($temp['is_birthday_group'] && !in_array('853479295568838706', $this->event->memberGroupIds())) {
            $this->discord->setRoles($this->event->guildId(), $this->event->userId(), "853479295568838706");
        }
    }
}