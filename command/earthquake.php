<?php

class earthquake extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $this->sendMessage(rand(0, 1) ? 'https://youtu.be/7gnzFlkmab8' : 'https://youtu.be/zBOt6Y2CcJE');
    }
}