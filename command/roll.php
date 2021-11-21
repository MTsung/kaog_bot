<?php

class roll extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $rand = rand(0, 100);
        $this->sendMessage($rand);
    }
}