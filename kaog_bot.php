<?php
use React\EventLoop\Factory;
use shanemcc\discord\DiscordClient;

include_once(__DIR__ ."/../../include/header.php");
define('CACHE_PATH',APP_PATH."cache/123/");

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/kaog.class.php';

set_time_limit(0);
ini_set('upload_max_filesize ', '800M');
ini_set('post_max_size', '800M');
ini_set('memory_limit', '-1');

error_log('kaog_bot run.'.DATE);

$clientID = '800231664336502804';
$clientSecret = 'sp81y1I5zO4R2Gyq3ULvvQ1fbLVoGzJ3';
$token = 'ODAwMjMxNjY0MzM2NTAyODA0.YAPH0A.p1hMKVzqVYD6aCQ7lqUb0Z1pas4';

$client = new DiscordClient($clientID, $clientSecret, $token);
$loop = Factory::create();
$client->setLoopInterface($loop);

$discord = new MTsung\discord($token);
$kaog = new MTsung\kaog($console,'bot_kaog','');

$kago_text = [
	[
		'message' => '我說很清楚了
這裡就是一個鋼琴交流群組
拜託 不要 來我這邊
想取得任何apex 交流以外的東西
你知道我今天從頭到尾只是覺得你很煩而已
我沒有說你在釣魚
也沒有預設你的立場
但你說的話就是會讓人感覺很討厭
然後 對人說話拜託有點尊重
就算我在你心裡是個白痴
是個智障
但拜託你
如果你還想跟別人溝通的話
至少先把尊重兩個字放在心上',
		'file' => null
	],
	[
		'message' => '<:sp4:501235091389939713>',
		'file' => null
	],
	[
		'message' => '',
		'file' => APP_PATH.'cronjob/kaog_bot/file/kaog_Illuminati.png'
	],
	[
		'message' => 'owo',
		'file' => null
	],
];


$time = [];
$client->on('event.MESSAGE_CREATE', function(DiscordClient $client, int $shard, String $event, Array $data){
	if ($data['author']['id'] == $client->getMyInfo()['id']){
	    return;
	}


    global $discord,$kago_text,$console,$time,$kaog;
    $guild_id = $data['guild_id'];// 群組 id
    $user_id = $data['author']['id'];// user id
    $username = $data['author']['username'];// username
    $channel_id = $data['channel_id'];// 頻道 id
	$content = $data['content'];// 內容
	$nick = $data['member']['nick'];

	// 紀錄訊息次數
	$guild_user = $guild_id.'_'.$user_id;
	if(!isset($time[$guild_user]) || (time() - $time[$guild_user] >= 10)){
		$input = [
			'guild_id' => $guild_id,
			'user_id' => $user_id,
			'member_nick' => $nick ?: $username,
			'count' => 1,
		];
		if($temp = $kaog->getData('where guild_id=? and user_id=?',[$guild_id, $user_id])){
			$input['id'] = $temp[0]['id'];
			$input['count'] = $temp[0]['count'] + 1;
		}
		// error_log(json_encode($input));
		$kaog->setData($input);
	}
	$time[$guild_user] = time();
	foreach ($time as $key => $value) {
		if(time() - $value >= 10){
			unset($time[$key]);
		}
	}
	// 紀錄訊息次數

	switch ($content) {
		case '!kaog':
		case '!敲擊':
	        $discord->setMessage($channel_id, '
> **:kaog:
> !網路很差
> !酒桶教學
> !傑夫失戀
> !Arad_is_Jakads
> !4k_dan
> !roll**');
			break;
		case '<:kaog:498532064337985556>':
	    	$key = rand(0, count($kago_text) - 1);
	        $discord->setMessage($channel_id, $kago_text[$key]['message'], $kago_text[$key]['file']);
			break;
		case '!4k_dan':
	    	$discord->setMessage($channel_id, 'https://sites.google.com/view/danreform/home');
			break;
		case '!roll':
	    	$discord->setMessage($channel_id, rand(0,100));
			break;
		case '!網路很差':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/網路很差.mp3');
			break;
		case '!酒桶教學':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/酒桶教學.mp4');
			break;
		case '!傑夫失戀':
	    	$discord->setMessage($channel_id, '請你們搞清楚 失戀亂打人是有法律層面的問題
你找個巷子拖進去打大家都睜一隻眼閉一隻眼 但不代表你就可以你在大庭廣眾下直接開扁诶');
			break;
		case '!Arad_is_Jakads':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/Arad.jpg');
			break;
		case '!exit':
			if($user_id == '327046840417517568'){
			    $discord->setMessage($channel_id, 'bye');
				error_log('kaog_bot bye.');
			    exit;
			}
			break;
	}

	
    // 敲擊手術室
	$rolesId = [
		'483324065369554976',// ☠☠☠☠包莖死人☠☠☠☠
		'799627678700273664',// ☺☺☺☺巨屌活人☺☺☺☺
	];
    if($channel_id == '800271393190051840'){//包莖
		$discord->setRoles($guild_id, $user_id, $rolesId[0]);
		$discord->rmRoles($guild_id, $user_id, $rolesId[1]);
    }else if($channel_id == '800272572339322930'){//巨屌活人
		$discord->setRoles($guild_id, $user_id, $rolesId[1]);
		$discord->rmRoles($guild_id, $user_id, $rolesId[0]);
    }
});

$client->connect();
$loop->run();