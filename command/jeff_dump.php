<?php

class jeff_dump implements command
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
        $this->discord->setMessage($this->event->channel_id(), '請你們搞清楚 失戀亂打人是有法律層面的問題
你找個巷子拖進去打大家都睜一隻眼閉一隻眼 但不代表你就可以你在大庭廣眾下直接開扁诶');
    }
}