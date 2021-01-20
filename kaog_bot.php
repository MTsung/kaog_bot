<?php

use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/discord.class.php';

set_time_limit(0);

error_log('kaog_bot run');

$clientID = '800231664336502804';
$clientSecret = 'sp81y1I5zO4R2Gyq3ULvvQ1fbLVoGzJ3';
$token = 'ODAwMjMxNjY0MzM2NTAyODA0.YAPH0A.p1hMKVzqVYD6aCQ7lqUb0Z1pas4';

$client = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$client->setLoopInterface($loop);

$discord = new MTsung\discord($token);

$client->on('event.MESSAGE_CREATE', function(DiscordClient $client, int $shard, String $event, Array $data){
    global $discord;
    error_log($data['content']);
    if(strpos($data['content'],':kaog:') !== false){
	    $discord->setMessage($data['channel_id'], '<:sp4:501235091389939713>');
    }
});

$client->connect();
$loop->run();