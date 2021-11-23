<?php

class bet extends baseCommand implements command
{
    const GROUP_ID_MILLION = '911974359097286688';
    const GROUP_ID_TEN_MILLION = '911974912120455169';
    const GROUP_ID_100_MILLION = '911974998611222588';
    const GROUP_ID_DONT_SEE_CHEATER = '911976843442266112';

    public function __construct($event, $discord)
    {
        parent::__construct($event, $discord);
    }

    public function run()
    {
        // 限定這些 channel 才能賭
        if (!in_array($this->event->channelId(), explode(',', BET_CHANNEL_ID))) {
            return false;
        }

        $useKaogCoin = $this->useKaogCoin($this->event->content());
        if ($useKaogCoin < 1) {
            return false;
        }

        if ($this->event->kaogCoin() < $useKaogCoin) {
            $this->sendMessage('<@'.$this->event->userId().'> 你的敲擊幣不夠 <:sp4:501235091389939713> 立即點擊連結儲值敲擊幣! https://a.mtsung.com/_/support');
            return false;
        }
        $temp = $this->event->discordUser()->getData('where user_id=?', [$this->event->userId()])[0];

        // 砍半
        if ($this->event->checkAaaaaaa()) {
            $this->sendMessage('AAAAAAA 一待一待一待一待 <@'.$this->event->userId().'> 滑倒了，一半敲擊幣拿去當醫藥費 <:kaogcoin:807899860140556288> <:kaogcoin:807899860140556288> :money_with_wings: :money_with_wings: ');
            $this->event->discordUser()->setData([
                'id' => $temp['id'],
                'kaog_coin' => ($temp['kaog_coin'] * 0.5),
                'aaaaaaa' => ((int)$temp['aaaaaaa'] + 1),
            ]);
            return false;
        }
        // 砍半

        // 一般
        // 49% +1 倍
        // 49% -1 倍
        // 1% +20 倍
        // 1% -5 倍
        $rand = rand(0, 99);
        $move = 0;
        if ($rand > 50) {
            $move = $useKaogCoin;
            $format = '<@%s> 獲得了 %s 顆敲擊幣，還剩下 %s 顆 <:kaog:498532064337985556>';
            $kaogCoin = $this->event->numberFormatString($useKaogCoin);
        } else if ($rand < 49) {
            $move = bcmul($useKaogCoin, -1);
            $format = '<@%s> 損失了 %s 顆敲擊幣，還剩下 %s 顆';
            $kaogCoin = $this->event->numberFormatString($useKaogCoin);
        } else if ($rand == 49) {
            $move = bcmul($useKaogCoin, -5);
            $format = '哭阿 <@%s> 損失了 %s 顆敲擊幣，還剩下 %s 顆 <:sp4:501235091389939713> <:sp4:501235091389939713>';
            $kaogCoin = $this->event->numberFormatString(bcmul($useKaogCoin, 5));
        } else if ($rand == 50) {
            $move = bcmul($useKaogCoin, 20);
            $format = '幹 <@%s> 獲得了 %s 顆敲擊幣，還剩下 %s 顆 <:sp4:501235091389939713> <:sp4:501235091389939713>';
            $kaogCoin = $this->event->numberFormatString(bcmul($useKaogCoin, 20));
        }

        $message = sprintf(
            $format,
            $this->event->userId(),
            $kaogCoin,
            $this->event->numberFormatString(bcadd($temp['kaog_coin'], $move))
        );
        $this->sendMessage($message);

        $___ = bcadd($temp['kaog_coin'], $move);
        $this->setGroup($___);
        $this->event->discordUser()->setData([
            'id' => $temp['id'],
            'kaog_coin' => ((strpos($___, '-') !== false) ? 0 : $___),
        ]);
        // 一般
    }

    private function useKaogCoin($content)
    {
        $content = explode(" ", $content);
        if ($content[1] == 'all') {
            return $this->event->kaogCoin();
        }

        if (!is_numeric($content[1])) {
            return 0;
        }

        if ($content[1] < 1) {
            return 0;
        }
        return $content[1];
    }

    private function setGroup($coin)
    {
        if ($coin >= 1000000) {
            $this->addMillion();
        } else {
            $this->rmMillion();
        }

        if ($coin >= 10000000) {
            $this->addTenMillion();
        } else {
            $this->rmTenMillion();
        }

        if ($coin >= 100000000) {
            $this->add100Million();
        } else {
            $this->rm100Million();
        }

        if ($coin >= 9223372036854775807) {
            $this->addDontSeeCheater();
        } else {
            $this->rmDontSeeCheater();
        }
    }

    // 百萬
    private function addMillion()
    {
        if (!in_array(self::GROUP_ID_MILLION, $this->event->memberGroupIds())) {
            $this->setRoles(self::GROUP_ID_MILLION);
        }
    }

    // 千萬
    private function addTenMillion()
    {
        if (!in_array(self::GROUP_ID_TEN_MILLION, $this->event->memberGroupIds())) {
            $this->setRoles(self::GROUP_ID_TEN_MILLION);
        }
    }

    // 億
    private function add100Million()
    {
        if (!in_array(self::GROUP_ID_100_MILLION, $this->event->memberGroupIds())) {
            $this->setRoles(self::GROUP_ID_100_MILLION);
        }
    }

    // 不看外掛
    private function addDontSeeCheater()
    {
        if (!in_array(self::GROUP_ID_DONT_SEE_CHEATER, $this->event->memberGroupIds())) {
            $this->setRoles(self::GROUP_ID_DONT_SEE_CHEATER);
        }
    }

    // 百萬
    private function rmMillion()
    {
        if (in_array(self::GROUP_ID_MILLION, $this->event->memberGroupIds())) {
            $this->rmRoles(self::GROUP_ID_MILLION);
        }
    }

    // 千萬
    private function rmTenMillion()
    {
        if (in_array(self::GROUP_ID_TEN_MILLION, $this->event->memberGroupIds())) {
            $this->rmRoles(self::GROUP_ID_TEN_MILLION);
        }
    }

    // 億
    private function rm100Million()
    {
        if (in_array(self::GROUP_ID_100_MILLION, $this->event->memberGroupIds())) {
            $this->rmRoles(self::GROUP_ID_100_MILLION);
        }
    }

    // 不看外掛
    private function rmDontSeeCheater()
    {
        if (in_array(self::GROUP_ID_DONT_SEE_CHEATER, $this->event->memberGroupIds())) {
            $this->rmRoles(self::GROUP_ID_DONT_SEE_CHEATER);
        }
    }
}