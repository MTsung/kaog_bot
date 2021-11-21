<?php

class earthquake extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage('https://youtu.be/zBOt6Y2CcJE');
    }
}