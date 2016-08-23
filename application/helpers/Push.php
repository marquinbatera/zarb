<?php
class Push
{
	protected $CI;
	
	public function __construct(){
		$this->CI =& get_instance();
	}

	public function sendPushNotification($tokens, $title, $message, $payload = []) {
		if(!is_array($tokens)) {
			$tokens = [$tokens];
		}

		$notification = [
			'title' => $title,
			'alert' => $message,
			'android' => [
				'payload' => $payload
			],
			'ios' => [
				'payload' => $payload
			]
		];

		$appId = 'c3dc1fa5';
		$appSecret = 'df53922540ac55a52b5e461405d59692f48e2bff9442fdec';

		$data = json_encode([
			'tokens' => $tokens,
			'production' => true,
			'notification' => $notification
		]);

		return json_decode(exec("curl -u $appSecret: -H \"Content-Type: application/json\" -H \"X-Ionic-Application-Id: $appId\" https://push.ionic.io/api/v1/push -d '$data'"));
	}

}

?>