<?php

class sleep extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $sleep_text = include(KAOG_BOT_PATH.'text/sleep.php');
        $key = rand(0, count($sleep_text) - 1);
        $this->sendMessage($sleep_text[$key]['message'], $sleep_text[$key]['file']);
    }
}