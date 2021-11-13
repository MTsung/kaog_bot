<?php

class bottom implements command
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
        $top = $this->event->discordUser()->getData('order by CHAR_LENGTH(kaog_coin) asc,kaog_coin asc limit 15');
        $message = '敲擊幣窮鬼榜
';
        foreach ($top as $key => $value) {
            $message .= '> '.($key + 1).'. '.$value['member_nick'].' 有 '.$this->event->number_format_string($value['kaog_coin']).' 顆敲擊幣
';
        }
        $this->discord->setMessage($this->event->channelId(), $message);
    }
}