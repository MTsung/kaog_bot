<?php

class jeffChan extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('', KAOG_BOT_PATH.'file/jeff_chan.jpg');
    }
}