<?php

class gragasTeaching extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('', KAOG_BOT_PATH.'file/酒桶教學.mp4');
    }
}