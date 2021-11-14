<?php

class aaaaaaa implements command
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
        $top = $this->event->discordUser()->getData('order by aaaaaaa desc limit 15');
        $message = '敲擊幣滑倒榜
';
        foreach ($top as $key => $value) {
            $message .= '> '.($key + 1).'. '.$value['member_nick'].' 滑倒了 '.$this->event->numberFormatString($value['aaaaaaa']).' 次
';
        }
        $this->discord->setMessage($this->event->channelId(), $message);
    }
}