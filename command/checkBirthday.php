<?php

class checkBirthday extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $temp = $this->event->discordUser()->getData('where user_id=?', [$this->event->userId()])[0];
        if ($temp['is_birthday_group'] && !in_array('853479295568838706', $this->event->memberGroupIds())) {
            $this->setRoles("853479295568838706");
        }
    }
}