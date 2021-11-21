<?php

class kaogCoin extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $msg = '<@'.$this->event->userId().'> 你有 '.$this->event->numberFormatString($this->event->kaogCoin()).' 顆敲擊幣 <:sp4:501235091389939713>';
        $this->sendMessage($msg);
    }
}