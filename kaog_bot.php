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

$c_text = [
	[
		'message' => '人品是一切之先行
沒有人品 不用討論
連話語權 出席權都沒有
沒有意義',
		'file' => null
	],
	[
		'message' => '其實我不是沒良心，只是面對看不見盡頭的絕望與傷悲，

我的心在一次次的受傷後，已經結出厚厚一層疤，

然後我學會不輕易去碰觸它。我善於隱藏，用幽默嘲弄生命的無常；

我試著不去看命運的殘酷，卻更感恩手裡能掌握的幸福。',
		'file' => null
	],
	[
		'message' => '朋友圈裡肯定有一個邏輯狂魔

會瘋狂說別人邏輯有問題

講一大堆別人根本不想看的東西

好幾行 手都不會酸一樣

就一直狂說自己立場的東西

還會把自己帶入別人的角度來說

邏輯狂魔到底在想什麼

常常就是邏輯狂魔搞的氣氛超級尷尬

你吵贏了這次 失去一個或多個朋友

值得嗎 ? 邏輯狂魔',
		'file' => null
	],
	[
		'message' => '沒關係 一次多一點 貢獻國庫',
		'file' => null
	],
	[
		'message' => '沒關係 我一起送
看他認不認為你在故意隱射',
		'file' => null
	],
	[
		'message' => '腦殘',
		'file' => null
	],
	[
		'message' => 'LLDX',
		'file' => null
	],
	[
		'message' => '邏輯死亡喔',
		'file' => null
	],
	[
		'message' => '單純邏輯問題',
		'file' => null
	],
	[
		'message' => '邏輯的問題',
		'file' => null
	],
	[
		'message' => '神邏輯',
		'file' => null
	],
	[
		'message' => '根本沒有邏輯',
		'file' => null
	],
	[
		'message' => '邏輯問題而已',
		'file' => null
	],
	[
		'message' => '這完全邏輯問題',
		'file' => null
	],
	[
		'message' => '重大聲明

我從未也無意在網路上公開或PO出證明
至少在巴哈姆特這種匿名論壇上沒有、也不可能會有
來說明我是專業法律人這件事

我沒有說我是不是專業法律人
請不要預設立場 這也沒有意義
你愛看就看 不愛看就滾
你沒有權利及義務要求我證明什麼
反之亦同 我沒有義務要拘束於你

我有寫錯 友善提醒 非常歡迎
我會做內容上合理的調整

拜託一下 倫理規範不是塑膠 我會怕怕
不要再跳針要我證明 一事不再理
諭知免訴 不要一直拿過來重複說

我只是一個 小小的
星爆暨吉娃娃廢文專業巴友',
		'file' => null
	],
	[
		'message' => '不用懷疑我的專業  這沒有意義

你只需要看我哪邊有寫錯

跟我說一聲 我們一起把它寫好就好

我歡迎合理且友善之討論 評判',
		'file' => null
	],
	[
		'message' => '不要問我幾歲 念哪裡畢業

我不願意透露我的私人資訊

再說

你為何不懷疑我這隻帳號

到底是不是多人使用一帳?',
		'file' => null
	],
	[
		'message' => '可憐
辯不贏看我不爽罷了',
		'file' => null
	],
	[
		'message' => '踢??????',
		'file' => null
	],
	[
		'message' => '我沒有說錯任何法律相關阿',
		'file' => null
	],
	[
		'message' => '就沒有說錯東西啊',
		'file' => null
	],
	[
		'message' => '奇怪
合法 為何我不能做',
		'file' => null
	],
	[
		'message' => '依法行言論阿',
		'file' => null
	],
	[
		'message' => '去我小屋首頁看',
		'file' => null
	],
	[
		'message' => '不用預設立場
沒有意義
我聲明過好幾次',
		'file' => null
	],
	[
		'message' => '我現在說 射在女童腿上 你們也不一定要看阿',
		'file' => null
	],
];

$sleep_text = [
	[
		'message' => '',
		'file' => APP_PATH.'cronjob/kaog_bot/file/jeff_sleep.png'
	],
	[
		'message' => '',
		'file' => APP_PATH.'cronjob/kaog_bot/file/www_sleep.png'
	],
];


$time = [];
$time_roll = [];
$count = [];
$client->on('event.MESSAGE_CREATE', function(DiscordClient $client, int $shard, String $event, Array $data){
	if ($data['author']['id'] == $client->getMyInfo()['id']){
	    return;
	}
    // error_log('kaog_bot memory_get_usage: '.memory_get_usage().'/'.memory_get_usage(true));

    global $discord, $kago_text, $sleep_text, $c_text, $console, $time, $count, $time_roll;
    
    // sql 連線閒置太久會消失 要重 new 
    if(!$console->conn->Execute('SHOW TABLES;')){
		$console->conn = ADONewConnection("pdo");
		$console->conn->connect('mysql:host='.MTsung\config::DB_HOST.';dbname='.MTsung\config::DB_NAME.';charset=utf8mb4',MTsung\config::DB_USER,MTsung\config::DB_PASSWORD);
		$console->conn->Execute("SET sql_mode = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';");
		$console->conn->Execute("SET NAMES utf8mb4;");
		$console->conn->Execute("SET CHARACTER_SET_CLIENT=utf8mb4;");
		$console->conn->Execute("SET CHARACTER_SET_RESULTS=utf8mb4;");
		$console->conn->Execute("SET CHARACTER_SET_CONNECTION=utf8mb4;");
		$console->conn->Execute("SET GLOBAL time_zone = '".MTsung\config::TIME_ZONE."';");
		$console->conn->Execute("SET time_zone = '".MTsung\config::TIME_ZONE."';");
		$console->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	}
	
	$kaog = new MTsung\kaog($console,'bot_kaog','');
	$cococola = new MTsung\dataList($console,'cococola','');
	$discord_user = new MTsung\dataList($console,'discord_user','');

    $guild_id = $data['guild_id'];// 群組 id
    $user_id = $data['author']['id'];// user id
    $username = $data['author']['username'];// username
    $channel_id = $data['channel_id'];// 頻道 id
	$content = $data['content'];// 內容
	$nick = $data['member']['nick'];

	// kaog_coin
	$input = [
		'user_id' => $user_id,
		'member_nick' => $nick ?: $username,
	];
	$kaog_coin_count = 1;
	if($temp = $discord_user->getData('where user_id=?',[$user_id])){
		if(((int)($temp[0]['last_ts'] ?? 0) + 1800 < time()) && !in_array($user_id, ['376342800377184256'])){
			$input['last_ts'] = time();
			$input['kaog_coin'] = bcadd(($temp[0]['kaog_coin'] ?? 0), 10);
		}
		$input['id'] = $temp[0]['id'];
		$kaog_coin_count = $input['kaog_coin'] ?: $temp[0]['kaog_coin'];
	}
	$discord_user->setData($input);
	// kaog_coin


	// 紀錄訊息次數
	$guild_user = $guild_id.'_'.$user_id;
	if(!isset($time[$guild_user]) || (time() - $time[$guild_user] >= 10)){
		$input = [
			'guild_id' => $guild_id,
			'user_id' => $user_id,
			'member_nick' => $nick ?: $username,
			'count' => 1,
			'year' => date('y'),
			'month' => date('n'),
		];
		if($temp = $kaog->getData('where guild_id=? and user_id=? and year=? and month=?',[$guild_id, $user_id, date('y'), date('n')])){
			$input['id'] = $temp[0]['id'];
			$input['count'] = $temp[0]['count'] + 1;
		}
		$kaog->setData($input);
		$time[$guild_user] = time();
	}
	foreach ($time as $key => $value) {
		if(time() - $value >= 10){
			unset($time[$key]);
		}
	}
	// 紀錄訊息次數

	$content = explode(" ", $content);

	//指令
	switch ($content[0]) {
		case '!kaog':
		case '!敲擊':
	        $discord->setMessage($channel_id, '
> **:kaog:
> !網路很差
> !酒桶教學
> !傑夫失戀
> !傑夫醬
> !Arad_is_Jakads
> !c哥
> !c哥語錄總集篇
> !特哥
> !水沙蓮
> !睡覺
> !4k_dan
> !roll
> !kaog_coin
> !bet <數量>
> !top
> !bottom
> (cd 半小時，任意頻道打字會獲得 10 顆敲擊幣)**');
			break;
		case '<:kaog:498532064337985556>':
	    	$key = rand(0, count($kago_text) - 1);
	        $discord->setMessage($channel_id, $kago_text[$key]['message'], $kago_text[$key]['file']);
			break;
		case '!4k_dan':
	    	$discord->setMessage($channel_id, 'https://sites.google.com/view/danreform/home');
			break;
		case '!roll':
			if(!isset($time_roll[$guild_user]) || (time() - $time_roll[$guild_user] >= 10)){
				$time_roll[$guild_user] = time();
				
				$rand = rand(0,100);
		    	$discord->setMessage($channel_id, $rand);
		    	if($rand == 0){
		    		$discord->setMessage($channel_id, '恭喜 <@'.$user_id.'> 獲得一隻傑夫醬', APP_PATH.'cronjob/kaog_bot/file/jeff_chan.jpg');
		    	}else if($rand == 100){
		    		$discord->setMessage($channel_id, '恭喜 <@'.$user_id.'> 獲得一隻敲擊', APP_PATH.'cronjob/kaog_bot/file/kaog.png');
		    	}
			}
			break;
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
		case '!kaog_coin':
		    $discord->setMessage($channel_id, '<@'.$user_id.'> 你有 '.number_format_string($kaog_coin_count).' 顆敲擊幣 <:sp4:501235091389939713>');
			break;
		case '!bet':
			if(!isset($time_roll[$guild_user]) || (time() - $time_roll[$guild_user] >= 5)){
				$time_roll[$guild_user] = time();
				
				if(!is_numeric($content[1])){
					break;
				}
				if($content[1] < 1){
					break;
				}
				if($kaog_coin_count < $content[1]){
		    		$discord->setMessage($channel_id, '<@'.$user_id.'> 你的敲擊幣不夠 <:sp4:501235091389939713> 立即點擊連結儲值敲擊幣! https://a.mtsung.com/_/support');
					break;
				}
				$temp = $discord_user->getData('where user_id=?',[$user_id])[0];
				$rand = rand(0,100);
				$move = 0;
		    	if($rand > 50){
		    		$move = $content[1];
		    		$discord->setMessage($channel_id, '<@'.$user_id.'> 獲得了 '.number_format_string($content[1]).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆 <:kaog:498532064337985556>');
		    	}else if($rand < 50){
		    		$move = bcmul($content[1], -1);
		    		$discord->setMessage($channel_id, '<@'.$user_id.'> 損失了 '.number_format_string($content[1]).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆');
		    	}else{
		    		$move = bcmul($content[1], 50);
		    		$discord->setMessage($channel_id, '幹 <@'.$user_id.'> 獲得了 '.number_format_string(bcmul($content[1], 50)).' 顆敲擊幣，還剩下 '.number_format_string(bcadd($temp['kaog_coin'], $move)).' 顆 <:sp4:501235091389939713> <:sp4:501235091389939713>');
		    	}
		    	$discord_user->setData([
		    		'id' => $temp['id'],
		    		'kaog_coin' => bcadd($temp['kaog_coin'], $move),
		    	]);
			}
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
		case '!傑夫醬':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/jeff_chan.jpg');
			break;
		case '!Arad_is_Jakads':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/Arad.jpg');
			break;
		case '!c哥':
	    	$key = rand(0, count($c_text) - 1);
	        $discord->setMessage($channel_id, $c_text[$key]['message'], $c_text[$key]['file']);
			break;
		case '!c哥語錄總集篇':
	    	$text = $cococola->getData('ORDER BY RAND() LIMIT 1');
	        $discord->setMessage($channel_id, htmlspecialchars_decode($text[0]['content'], ENT_QUOTES));
			break;
		case '!特哥':
	    	$discord->setMessage($channel_id, '雷中之雷 貫中貫己 
姆中網中 清口聽聽', APP_PATH.'cronjob/kaog_bot/file/ter.png');
			break;
		case '!水沙蓮':
	    	$discord->setMessage($channel_id, 'https://youtu.be/S9lVCA2xv40');
			break;
		case '!睡覺':
	    	$key = rand(0, count($sleep_text) - 1);
	    	$discord->setMessage($channel_id, $sleep_text[$key]['message'], $sleep_text[$key]['file']);
			break;
		case '!ななひら':
		case '!nanahira':
	    	$discord->setMessage($channel_id, '', APP_PATH.'cronjob/kaog_bot/file/nanahira.mp3');
			break;
		case '!exit':
			if($user_id == '327046840417517568'){
			    $discord->setMessage($channel_id, 'bye');
				error_log('kaog_bot bye.');
			    exit;
			}
	    	$discord->setMessage($channel_id, ':question:');
			break;
	}
	//指令




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


function number_format_string($number, $delimeter = ','){
    return strrev(implode($delimeter, str_split(strrev($number), 3)));
}