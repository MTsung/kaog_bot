<?php

class gragasTeaching1 extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('', KAOG_BOT_PATH.'file/洗刷屋民.mp4');
    }
}