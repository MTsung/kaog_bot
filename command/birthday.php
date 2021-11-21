<?php

class birthday extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->setRoles("853479295568838706");
        $temp = $this->event->discordUser()->getData('where user_id=?', [$this->event->userId()])[0];
        $this->event->discordUser()->setData([
            'id' => $temp['id'],
            'is_birthday_group' => 1,
        ]);
    }
}