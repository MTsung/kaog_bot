<?php

use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;

include_once(__DIR__."/../../include/header.php");
require_once(__DIR__.'/vendor/autoload.php');
require_once(__DIR__.'/kaog.class.php');
require_once(__DIR__.'/config.php');
include_once(__DIR__.'/kaog_bot_event.class.php');
include_once(__DIR__.'/kaog_bot_embeds.class.php');

define('CACHE_PATH', APP_PATH."cache/123/");

// error_reporting(E_ALL);
set_time_limit(0);
ini_set('memory_limit', '-1');

error_log('kaog_bot2 run.'.DATE);

$client = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$client->setLoopInterface($loop);

$discord = new MTsung\discord($token);
$kago_text = include(APP_PATH.'cronjob/kaog_bot/text/kaog.php');
$c_text = include(APP_PATH.'cronjob/kaog_bot/text/cococola.php');
$sleep_text = include(APP_PATH.'cronjob/kaog_bot/text/sleep.php');


$time_roll = [];
$time_bet = [];
$aaaaaaa_count = 100;
$aaaaaaa_number = rand(100, 300);
$client->on('event.MESSAGE_CREATE', function (DiscordClient $client, int $shard, string $event, array $data) {
    if ($data['author']['id'] == $client->getMyInfo()['id']) return;

    global $console, $discord;
    global $time_roll, $aaaaaaa_count, $aaaaaaa_number;

// 暫時exit
    if ($data['content'] == "exit" && $data['author']['id'] == '327046840417517568') {
        $discord->setMessage($data['channel_id'], 'bye');
        error_log('kaog_bot bye.');
        exit;
    }

    kaog_bot_event::run($console, $discord)
        ->setData($client, $shard, $event, $data)
        ->runSql()
        ->setKaogCoin()
        ->command();

    error_log($data['content']);
    return;
    error_log('kaog_bot2 exit.'.DATE);
    exit;

    $content = explode(" ", $content);

    //指令
    switch ($content[0]) {
        case '!top':
            $top = $discord_user->getData('order by CHAR_LENGTH(kaog_coin) desc,kaog_coin desc limit 15');
            $message = '敲擊幣富豪榜
';
            foreach ($top as $key => $value) {
                $message .= '> '.($key + 1).'. '.$value['member_nick'].' 有 '.number_format_string($value['kaog_coin']).' 顆敲擊幣
';
            }
            $discord->setMessage($channel_id, $message);
            break;
        case '!bottom':
            $top = $discord_user->getData('order by CHAR_LENGTH(kaog_coin) asc,kaog_coin asc limit 15');
            $message = '敲擊幣窮鬼榜
';
            foreach ($top as $key => $value) {
                $message .= '> '.($key + 1).'. '.$value['member_nick'].' 有 '.number_format_string($value['kaog_coin']).' 顆敲擊幣
';
            }
            $discord->setMessage($channel_id, $message);
            break;
        case '!aaaaaaa':
            $top = $discord_user->getData('order by aaaaaaa desc limit 15');
            $message = '敲擊幣滑倒榜
';
            foreach ($top as $key => $value) {
                $message .= '> '.($key + 1).'. '.$value['member_nick'].' 滑倒了 '.number_format_string($value['aaaaaaa']).' 次
';
            }
            $discord->setMessage($channel_id, $message);
            break;
        case '!bet':
            if (!in_array($channel_id, ['806901192654585867', '406747700415954955', '800260290779938826'])) {
                break;
            }
// 			if($user_id != '327046840417517568'){
// 			    $discord->setMessage($channel_id, '敲擊累了');
// 				break;
// 			}
            if (!isset($time_bet[$guild_user]) || (time() - $time_bet[$guild_user] >= 3)) {
                $time_bet[$guild_user] = time();

                if ($content[1] == 'all') {
                    $content[1] = $kaog_coin_count;
                }
                if (!is_numeric($content[1])) {
                    break;
                }
                if ($content[1] < 1) {
                    break;
                }
                if ($kaog_coin_count < $content[1]) {
                    $discord->setMessage($channel_id, '<@'.$user_id.'> 你的敲擊幣不夠 <:sp4:501235091389939713> 立即點擊連結儲值敲擊幣! https://a.mtsung.com/_/support');
                    break;
                }
                $temp = $discord_user->getData('where user_id=?', [$user_id])[0];
                // 砍半
                if ((rand(0, 2000) == 0) || (($aaaaaaa_count++) == $aaaaaaa_number)) {
                    $aaaaaaa_count = 0;
                    $aaaaaaa_number = rand(100, 300);
                    $discord->setMessage($channel_id, 'AAAAAAA 一待一待一待一待 <@'.$user_id.'> 滑倒了，一半敲擊幣拿去當醫藥費 <:kaogcoin:807899860140556288> <:kaogcoin:807899860140556288> :money_with_wings: :money_with_wings: ');
                    $discord_user->setData([
                        'id' => $temp['id'],
                        'kaog_coin' => ($temp['kaog_coin'] * 0.5),
                        'aaaaaaa' => ((int)$temp['aaaaaaa'] + 1),
                    ]);
                    break;
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
                    $move = $content[1];
                    $discord->setMessage($channel_id, '<@'.$user_id.'> 獲得了 '.number_format_string($content[1]).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆 <:kaog:498532064337985556>');
                } else if ($rand < 49) {
                    $move = bcmul($content[1], -1);
                    $discord->setMessage($channel_id, '<@'.$user_id.'> 損失了 '.number_format_string($content[1]).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆');
                } else if ($rand == 49) {
                    $move = bcmul($content[1], -5);
                    $discord->setMessage($channel_id, '哭阿 <@'.$user_id.'> 損失了 '.number_format_string(bcmul($content[1], 5)).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆 <:sp4:501235091389939713> <:sp4:501235091389939713>');
                } else if ($rand == 50) {
                    $move = bcmul($content[1], 20);
                    $discord->setMessage($channel_id, '幹 <@'.$user_id.'> 獲得了 '.number_format_string(bcmul($content[1], 20)).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆 <:sp4:501235091389939713> <:sp4:501235091389939713>');
                }
                $___ = bcadd($temp['kaog_coin'], $move);
                $discord_user->setData([
                    'id' => $temp['id'],
                    'kaog_coin' => ((strpos($___, '-') !== false) ? 0 : $___),
                ]);
                // 一般
            }
            break;
        case '!c哥':
        case '!c':
            $key = rand(0, count($c_text) - 1);
            $discord->setMessage($channel_id, $c_text[$key]['message'], $c_text[$key]['file']);
            break;
        case '!c哥語錄總集篇':
        case '!c_all':
            $text = $cococola->getData('ORDER BY RAND() LIMIT 1');
            $discord->setMessage($channel_id, htmlspecialchars_decode($text[0]['content'], ENT_QUOTES));
            break;
    }
    //指令


    // 生日快樂
    if (in_array("<@&853479295568838706>", $content)) {
        $discord->setRoles($guild_id, $user_id, "853479295568838706");
    }

    // 敲擊手術室
    $rolesId = [
        '483324065369554976',// ☠☠☠☠包莖死人☠☠☠☠
        '799627678700273664',// ☺☺☺☺巨屌活人☺☺☺☺
    ];
    if ($channel_id == '800271393190051840') {//包莖
        $discord->setRoles($guild_id, $user_id, $rolesId[0]);
        $discord->rmRoles($guild_id, $user_id, $rolesId[1]);
    } else if ($channel_id == '800272572339322930') {//巨屌活人
        $discord->setRoles($guild_id, $user_id, $rolesId[1]);
        $discord->rmRoles($guild_id, $user_id, $rolesId[0]);
    }
});

$client->connect();
$loop->run();