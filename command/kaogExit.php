<?php

class kaogExit extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        if ($this->event->userId() == ADMIN_ID) {
            $this->sendMessage('bye');
            error_log('kaog_bot2 bye.');
            exit;
        }
        $this->sendMessage(':question:');
    }
}