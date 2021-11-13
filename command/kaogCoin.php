<?php

class kaogCoin implements command
{
    private $discord;
    private $event;

    public function __construct($event, $discord)
    {
        $this->discord = $discord;
        $this->event = $event;
    }

    public function run()
    {
        $msg = '<@'.$this->event->userId().'> 你有 '.$this->event->numberFormatString($this->event->kaogCoin()).' 顆敲擊幣 <:sp4:501235091389939713>';
        $this->discord->setMessage($this->event->channelId(), $msg);
    }
}