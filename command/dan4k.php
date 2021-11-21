<?php

class dan4k extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('https://sites.google.com/view/danreform/home');
    }
}