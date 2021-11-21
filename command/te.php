<?php

class te extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('雷中之雷 貫中貫己 
姆中網中 清口聽聽', KAOG_BOT_PATH.'file/ter.png');
    }
}