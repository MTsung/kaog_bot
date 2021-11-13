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

$discord = new MTsung\discord($token);
$client = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$client->setLoopInterface($loop);

$client->on('event.MESSAGE_CREATE', function (DiscordClient $client, int $shard, string $event, array $data) use ($console, $discord) {
    if ($data['author']['id'] == $client->getMyInfo()['id']) return;
    kaogBotEvent::run($console, $discord)
        ->setData($client, $shard, $event, $data)
        ->runSql()
        ->setKaogCoin()
        ->command();
});

$client->connect();
$loop->run();