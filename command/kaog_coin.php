<?php

class kaog_coin implements command
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
        $msg = '<@'.$this->event->user_id().'> 你有 '.number_format_string($this->event->kaog_coin()).' 顆敲擊幣 <:sp4:501235091389939713>';
        $this->discord->setMessage($this->event->channel_id(), $msg);
    }
}