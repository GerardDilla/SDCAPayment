<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define ('HMAC_SHA256', 'sha256');
//*test secret key* define ('S_KEY', '61c3121bc48e412c97a806cbd671bc34f7ca4a49d8d54a15a5f3bfc8534689f921fb8bcaf8ec430082e3d211a39774349f97f95ac5834b49b7fec3126092ca3ce0c37dc7f06b486fa5add273838d02cf66fb0955754344aeba3c6dbae88606d9d0db2c7076314060b6c372248014b8a96311174c9aed43b3b2df0e41ebf3c402');
define ('S_KEY', '02fd2ff219fc45a98bfefe049a2435e941708e43a0354245a444f8f2c821671a8ae907edf3394582992bd76d6e08d4459749a0e28e2f4ff99b7c423072dd3e7ad45d84cf0f604614ae21da72c4df9211da7fbdd84d16484db061a2785f18d24d8d0a6e45689749e3941bbc03fec01296df62ae44fc3f4df38d7a5ea9ec62c295');
class ub 
{
	
	public function test(){

		return 'test';

	}

	function sign($params){

		return $this->signData($this->buildDataToSign($params), S_KEY);

	}
	
	function signData($data, $secretKey){

		return base64_encode(hash_hmac('sha256', $data, $secretKey, true));

	}
	
	function buildDataToSign($params){

		$signedFieldNames = explode(",",$params["signed_field_names"]);
		foreach ($signedFieldNames as $field) {
			$dataToSign[] = $field."=".$params[$field];
		}
		return $this->commaSeparate($dataToSign);

	}
	
	function commaSeparate ($dataToSign){

		return implode(",",$dataToSign);

	}



}