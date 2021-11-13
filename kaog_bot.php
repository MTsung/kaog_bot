<?php

use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;

include_once(__DIR__."/../../include/header.php");
include_once(__DIR__.'/vendor/autoload.php');
include_once(__DIR__.'/config.php');
include_once(__DIR__.'/kaogBotEvent.class.php');
include_once(__DIR__.'/kaogBotEmbeds.class.php');

define('CACHE_PATH', APP_PATH."cache/kaog_bot/");

// error_reporting(E_ALL);
set_time_limit(0);
ini_set('memory_limit', '-1');

error_log('kaog_bot2 run.'.DATE);

$client = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$client->setLoopInterface($loop);

$discord = new MTsung\discord($token);

$client->on('event.MESSAGE_CREATE', function (DiscordClient $client, int $shard, string $event, array $data) {
    if ($data['author']['id'] == $client->getMyInfo()['id']) return;

    global $console, $discord;

    kaogBotEvent::run($console, $discord)
        ->setData($client, $shard, $event, $data)
        ->runSql()
        ->setKaogCoin()
        ->command();

    $content = explode(" ", $content);

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