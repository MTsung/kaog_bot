<?php

class kaog extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $text = include(KAOG_BOT_PATH.'text/kaog.php');
        $key = rand(0, count($text) - 1);
        $this->sendMessage($text[$key]['message'], $text[$key]['file']);
    }
}