<?php

class kaogBotEvent
{
    private static $instance;

    private $kaog_coin_min = 50;// 破產後的 default
    private $kaog_coin_time = 1800;// 多少秒得到一次 kaog coin
    private $kaog_coin_tolerance = 1000;// 一次得到多少 kaog coin

    private $kaog_coin_count = 0;

    private $aaaaaaa_count;// 被 bet 幾次了
    private $aaaaaaa_number;// 到這個數會滑倒

    private $console;
    private $client;
    private $shard;
    private $event;
    private $data;
    private $discord;

    private $cococola;
    private $discordUser;

    private $command = [
        '!help' => 'help',
        '!kaog' => 'help',
        '!敲擊' => 'help',
        '<:kaog:498532064337985556>' => 'kaog',
        '!4k_dan' => 'dan4k',
        '!roll' => 'roll',
        '!top' => 'top',
        '!bottom' => 'bottom',
        '!aaaaaaa' => 'aaaaaaa',
        '!kaog_coin' => 'kaogCoin',
        '!bet' => 'bet',
        '!網路很差' => 'networkIsBad',
        '!酒桶教學' => 'gragasTeaching',
        '!傑夫失戀' => 'jeffDump',
        '!傑夫醬' => 'jeffChan',
        '!Arad_is_Jakads' => 'aradIsJakads',
        '!c哥' => 'c',
        '!c' => 'c',
        '!c哥語錄總集篇' => 'cAll',
        '!c_all' => 'cAll',
        '!特哥' => 'te',
        '!水沙蓮' => 'nijuu',
        '!睡覺' => 'sleep',
        '!ななひら' => 'nanahira',
        '!nanahira' => 'nanahira',
        '!exit' => 'kaogExit',
        '!地震' => 'earthquake',
        '​!打架' => 'fight',
    ];

    private $contentContain = [
        '<@&853479295568838706>' => 'birthday',
    ];

    private $channelIdContain = [
        '800271393190051840' => 'seam',
        '800272572339322930' => 'cut',
        '406747700415954955' => 'checkBirthday'
    ];

    private function __construct($console, $discord)
    {
        $this->console = $console;
        $this->discord = $discord;

        $this->cococola = new MTsung\center($this->console, 'cococola', '');
        $this->discordUser = new MTsung\center($this->console, 'discord_user', '');
    }

    public static function run($console, $discord)
    {
        if (!self::$instance) {
            self::$instance = new self($console, $discord);
        }

        return self::$instance;
    }

    public function setData($client, $shard, $event, $data)
    {
        $this->client = $client;
        $this->shard = $shard;
        $this->event = $event;
        $this->data = $data;
        // error_log(json_encode([$client,$shard,$event,$data]));
        return $this;
    }

    public function runSql()
    {
        if (!$this->console->conn->Execute('SELECT 1')) {
            $this->console->conn = ADONewConnection("pdo");
            $this->console->conn->connect(
                'mysql:host='.MTsung\config::DB_HOST.';dbname='.MTsung\config::DB_NAME.';charset=utf8mb4',
                MTsung\config::DB_USER,
                MTsung\config::DB_PASSWORD
            );
            $this->console->conn->Execute("SET sql_mode = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';");
            $this->console->conn->Execute("SET NAMES utf8mb4;");
            $this->console->conn->Execute("SET CHARACTER_SET_CLIENT=utf8mb4;");
            $this->console->conn->Execute("SET CHARACTER_SET_RESULTS=utf8mb4;");
            $this->console->conn->Execute("SET CHARACTER_SET_CONNECTION=utf8mb4;");
            $this->console->conn->Execute("SET GLOBAL time_zone = '".MTsung\config::TIME_ZONE."';");
            $this->console->conn->Execute("SET time_zone = '".MTsung\config::TIME_ZONE."';");
            $this->console->conn->SetFetchMode(ADODB_FETCH_ASSOC);
            $this->cococola = new MTsung\center($this->console, 'cococola', '');
            $this->discordUser = new MTsung\center($this->console, 'discord_user', '');
        }

        return $this;
    }


    // kaog coin
    public function setKaogCoin()
    {
        // 只有採白塊才有這機制
        if ($this->guildId() != MANIA_ID) return $this;

        $input = [
            'user_id' => $this->userId(),
            'member_nick' => $this->nickname() ?: $this->username(),
        ];

        $this->kaog_coin_count = $this->kaog_coin_min;

        if ($temp = $this->discordUser->getData('where user_id=?', [$this->userId()])) {
            $user = $temp[0];
            $last_ts = (int)($user['last_ts'] ?? 0);
            $now = time();
            $user['kaog_coin'] = $user['kaog_coin'] ?? 0;
            $input['id'] = $user['id'];
            if ($last_ts + $this->kaog_coin_time < $now) {
                $input['last_ts'] = $now;
                $input['kaog_coin'] = bcadd($user['kaog_coin'], $this->kaog_coin_tolerance);
            }
            $this->kaog_coin_count = $input['kaog_coin'] ?: $user['kaog_coin'];
        }

        if ($this->kaog_coin_count <= 0) {
            $this->kaog_coin_count = $input['kaog_coin'] = $this->kaog_coin_min;
        }

        $this->discordUser->setData($input);

        return $this;
    }

    public function checkAaaaaaa()
    {
        // 固定機率滑倒
        if (rand(0, 2000) == 0) {
            return true;
        }

        if ($this->aaaaaaa_number == 0) {
            $this->resetAaaaaaa();
        }

        if ($this->aaaaaaa_number == $this->aaaaaaa_count++) {
            $this->resetAaaaaaa();
            return true;
        }
        return false;
    }

    private function resetAaaaaaa()
    {
        $this->aaaaaaa_number = rand(100, 300);
    }

    public function command()
    {
        if (!$this->content()) return $this;

        // 第一個空白前文字當指令
        $content = explode(" ", $this->content());
        $this->r($this->command[$content[0]] ?? '');

        // 傳送的內容包含就執行
        if ($this->contentContain) {
            foreach ($this->contentContain as $text => $className) {
                if (strpos($this->content(), $text) !== false){
                    $this->r($className);
                }
            }
        }

        // 在某個 channel 就執行
        $this->r($this->channelIdContain[$this->channelId()] ?? '');

        return $this;
    }

    private function r($className)
    {
        if ($className && is_file(KAOG_BOT_PATH.'command/'.$className.'.php')) {
            require_once(KAOG_BOT_PATH.'command/command.php');
            require_once(KAOG_BOT_PATH.'command/baseCommand.php');
            require_once(KAOG_BOT_PATH.'command/'.$className.'.php');
            (new $className($this, $this->discord))->run();
        }
    }

    // 群組 id
    public function guildId()
    {
        return $this->data['guild_id'];
    }

    // user id
    public function userId()
    {
        return $this->data['author']['id'];
    }

    // username
    public function username()
    {
        return $this->data['author']['username'];
    }

    // 頻道 id
    public function channelId()
    {
        return $this->data['channel_id'];
    }

    // 內容
    public function content()
    {
        return $this->data['content'];
    }

    // 暱稱
    public function nickname()
    {
        return $this->data['member']['nick'];
    }

    public function kaogCoin()
    {
        return $this->kaog_coin_count;
    }

    public function cococola()
    {
        return $this->cococola;
    }

    public function discordUser()
    {
        return $this->discordUser;
    }

    public function memberGroupIds()
    {
        return $this->data['member']['roles'];
    }

    public function numberFormatString($number, $delimeter = ',')
    {
        $number = explode('.', $number)[0];
        if (strpos($number, '-') !== false) {
            return "0";
        }
        for ($i = $sub_i = 0; $i < strlen($number); $i++) {
            if ($number[$i]) {
                break;
            }
            $sub_i++;
        }
        $number = substr($number, $sub_i);
        return strrev(implode($delimeter, str_split(strrev($number), 3))) ?: 0;
    }
}