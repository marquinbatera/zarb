<?php
class Session_model extends CI_Model {
	private $id = "session_id"; // PK
	private $token = "token";
	private $user_id = "user_id";
	private $created_at = "created_at";
	private $updated_at = "updated_at";
	private $expiration = "expiration";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function create( $session ){

	}

	public function update( $session ){

	}

	public function getByToken( $token ){
		
	}

	public function destroy( $token ){
		
	}

	public function extractCredentials( $base64 ){
		$base64 = base64_decode($base64);
		$base64 = explode("|", $base64);

		if (count($base64) == 2){
			$username = $base64[0];
			$password = $base64[1];

			retun array(
				"username" => $username,
				"password" => $password
			);
		} else {
			return false;
		}
	}
}