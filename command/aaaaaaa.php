<?php

class aaaaaaa extends baseCommand implements command
{
    
    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
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
        $this->sendMessage($message);
    }
}