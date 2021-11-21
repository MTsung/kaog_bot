<?php

class cAll extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $message = $this->event->cococola()->getData('order by RAND() limit 1')[0]['content'];
        $this->sendMessage(htmlspecialchars_decode($message, ENT_QUOTES));
    }
}