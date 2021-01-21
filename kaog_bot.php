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

	$rolesId = [
		'483324065369554976',// ☠☠☠☠包莖死人☠☠☠☠
		'799627678700273664',// ☺☺☺☺巨屌活人☺☺☺☺
	];

    $guild_id = $data['guild_id'];// 群組 id
    $user_id = $data['author']['id'];// user id
    $channel_id = $data['channel_id'];// 頻道 id

    if(strpos($data['content'],':kaog:') !== false){
	    $discord->setMessage($channel_id, '<:sp4:501235091389939713>');
    }


    if($channel_id == '800271393190051840'){
    	//包莖
		$discord->setRoles($guild_id, $user_id, $rolesId[0]);
		$discord->rmRoles($guild_id, $user_id, $rolesId[1]);
    }else if($channel_id == '800272572339322930'){
    	//巨屌活人
		$discord->setRoles($guild_id, $user_id, $rolesId[1]);
		$discord->rmRoles($guild_id, $user_id, $rolesId[0]);
    }
});

$client->connect();
$loop->run();