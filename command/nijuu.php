<?php

class nijuu extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('https://youtu.be/S9lVCA2xv40');
    }
}