<?php

class top extends baseCommand implements command
{

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        $top = $this->event->discordUser()->getData('order by CHAR_LENGTH(kaog_coin) desc,kaog_coin desc limit 15');
        $message = '敲擊幣富豪榜
';
        foreach ($top as $key => $value) {
            $message .= '> '.($key + 1).'. '.$value['member_nick'].' 有 '.$this->event->numberFormatString($value['kaog_coin']).' 顆敲擊幣
';
        }
        $this->sendMessage($message);
    }
}