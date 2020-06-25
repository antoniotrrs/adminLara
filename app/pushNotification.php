<?php

namespace App;

class pushNotification {

#	private static $API_ACCESS_KEY

// Produccion
private static $API_ACCESS_KEY;

	// (iOS) Private key's passphrase.
	private static $passphrase = '';

	// (iOS) Set if is for production mode
	private static $production = false;

	public function __construct() {
	}


	public function sendNotification($titulo,$mensaje,$usuarios) {


		$usus = json_decode($usuarios);




			$url = 'https://fcm.googleapis.com/fcm/send';


	        $notification = [
	            'title' => $titulo,
	            'text' => $mensaje
	        ];

	        $headers = [
	        	'Authorization' => 'key=AAAAiHWkVfs:APA91bHDHjraVsT-A9UnK4s0jRWFAhwR-e2X0RApg_1tngE3qTV2qwliH4v1X5ypl0eukCYo2qux1WSjxZ5Jk91E1OFmEKd456EwAa1ZHrMdIsxuBuvvJZUW0_GYF7zkFKWGPz9w1t-f',
	        	'Content-Type' => 'application/json'

	        ];

				 if(empty($usus)){

					$fields = [
	            //'to' => 'dBrkV42xKSw:APA91bHAPxN1zBfVTJIxQ5uNNM3oC9HFfcterDgDzeWrdgCOO_F-YU9nWL-JWdusVEu7H_jcrGTZ4f34U4vOP7oofK7AwLHEuAy4VDtM9AIN_U-udwLTW_Dl3D_0duCE4eWP-Zq5heK3',
              'to' => "/topics/test",
	            'notification' => $notification
	        ];
				}else{
					$fields = [
	            //'to' => 'dBrkV42xKSw:APA91bHAPxN1zBfVTJIxQ5uNNM3oC9HFfcterDgDzeWrdgCOO_F-YU9nWL-JWdusVEu7H_jcrGTZ4f34U4vOP7oofK7AwLHEuAy4VDtM9AIN_U-udwLTW_Dl3D_0duCE4eWP-Zq5heK3',
              'registration_ids' => $usus,
	            'notification' => $notification
	        ];
				}

	    	return $this->useCurl($url, $headers, $fields);




    }


	// Curl
	private function useCurl($url, $headers, $fields = null) {
	        // Open connection

		if(function_exists('curl_init')){

	        $ch = curl_init();

	        if ($url) {

	        	$headersPrev = $headers;
	        	$headers = [];

	        	foreach($headersPrev AS $key => $value){
	        		array_push($headers, $key.": ".$value);
	        	}

	        	$fields = json_encode($fields);

	            curl_setopt($ch, CURLOPT_URL, $url);
	            curl_setopt($ch, CURLOPT_POST, true);
	            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	            // Disabling SSL Certificate support temporarly
	            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	            if ($fields) {
	                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	            }

	            // Execute post
	            $result = curl_exec($ch);
	            if ($result === FALSE) {
	                die('Curl failed: ' . curl_error($ch));
	            }

	            // Close connection
	            curl_close($ch);
				$valid = json_decode($result, true);
        return true;
        	}else{
        		return false;
        	}

        }else{

			$client = new \GuzzleHttp\Client();
			$result = false;

			try{

				$response = $client->request('POST', $url, ['headers' => $headers, 'json' => $fields]);

				if($response->getStatusCode() == 200){
					$result = true;
				}

			}
			catch(Exception $e){}

			return $result;

        }

    }

}

?>
