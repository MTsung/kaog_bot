<?php

namespace MTsung{

	class discord{
		var $token;

		function __construct($token){
			$this->token = $token;
		}
		
		function setMessage($channel_id, $message){
			$url = "/channels/".$channel_id."/messages";
			$response = $this->curl($url,
			'POST',[
				"content" => $message,
				"nonce" => 1,
				"tts" => false,
			]);
			$response = json_decode($response,true);
			return $response;
		}

		function getMessage($channelsId,$after = null,$limit = 50){
			$url = "/channels/".$channelsId."/messages";
			if($after){
    			$response = $this->curl($url,'GET',[
    				'limit' => $limit,
    				'after' => $after,
    			]);
			}else{
    			$response = $this->curl($url,'GET',[
    				'limit' => $limit,
    			]);
			}
			$response = json_decode($response,true);
			return $response;
		}

		function getMember($guilds,$member_id){
			$url = "/guilds/".$guilds."/members/".$member_id;
			$response = $this->curl($url,'GET');
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 取得伺服器
		 */
		function getGuilds(){
			$url = "/users/@me/guilds";
			$response = $this->curl($url,'GET');
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 取得所有身分組
		 */
		function getRoles($guilds){
			$url = "/guilds/".$guilds."/roles";
			$response = $this->curl($url,'GET');
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 取得會員
		 */
		function getUserList($guilds,$limit = 10){
			$url = "/guilds/".$guilds."/members";
			$response = $this->curl($url,'GET',[
				'limit' => $limit
			]);
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 設定身分組
		 */
		function setRoles($guilds,$member_id,$rolesId){
			$url = "/guilds/".$guilds."/members/".$member_id."/roles/".$rolesId;
			$response = $this->curl($url,'PUT');
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 刪除身分組
		 */
		function rmRoles($guilds,$member_id,$rolesId){
			$url = "/guilds/".$guilds."/members/".$member_id."/roles/".$rolesId;
			$response = $this->curl($url,'DELETE');
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * 修改名稱
		 * @param [type] $id   [description]
		 * @param [type] $nick [description]
		 */
		function setUserNick($guilds,$member_id,$nick){
			$url = "/guilds/".$guilds."/members/".$member_id;
			$response = $this->curl($url,'PATCH',["nike" => $nick]);
			$response = json_decode($response,true);
			return $response;
		}

		/**
		 * curl
		 * @param  string $url     網址
		 * @param  string $type    GET or POST
		 * @param  array  $data    資料
		 * @param  array  $options curl 設定
		 * @param  array  $header  header
		 */
		function curl($url,$type="GET",$data=[],$options=[]) {
			$input = [
				'url' => $url,
				'type' => $type,
				'data' => $data,
				'options' => $options,
			];
			$header = [
				"Authorization:	Bot ".$this->token,
				"Content-Type: application/json"
			];
			$ch = curl_init();

			if(strtoupper($type) == "GET"){
				$url = $url."?".http_build_query($data);
			}else{//POST
				if(in_array("Content-Type: multipart/form-data", $header)){
					$options = [
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => $data
					];
				}else{
					$options = [
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => json_encode($data)
					];
				}
			}

			$defaultOptions = [
				CURLOPT_CUSTOMREQUEST => $type,
				CURLOPT_URL => 'https://discord.com/api/v8'.$url,
				CURLOPT_HTTPHEADER => $header,
				CURLOPT_RETURNTRANSFER => true, 		// 不直接出現回傳值
				CURLOPT_SSL_VERIFYPEER => false,		// ssl
				CURLOPT_SSL_VERIFYHOST => false,		// ssl
				CURLOPT_HEADER => true 					//取得header
			];
			$options = $options + $defaultOptions;
			curl_setopt_array($ch, $options);

			$response = curl_exec($ch);

			if(curl_error($ch)){
				throw new Exception(curl_error($ch), curl_errno($ch));
			}

			$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header = substr($response, 0, $headerSize);
			$response = substr($response, $headerSize);

			$res = json_decode($response,true);
			if(isset($res['retry_after'])){
				sleep((int)ceil(json_decode($response,true)['retry_after']));
				return curl($input['url'], $input['type'], $input['data'], $input['options']);
			}
			return $response;
		}
	}
}