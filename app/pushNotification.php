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


	public function sendNotification($titulo,$mensaje) {



			$url = 'https://fcm.googleapis.com/fcm/send';


	        $notification = [
	            'title' => $titulo,
	            'text' => $mensaje
	        ];

	        $headers = [
	        	'Authorization' => 'key=AAAAiHWkVfs:APA91bHDHjraVsT-A9UnK4s0jRWFAhwR-e2X0RApg_1tngE3qTV2qwliH4v1X5ypl0eukCYo2qux1WSjxZ5Jk91E1OFmEKd456EwAa1ZHrMdIsxuBuvvJZUW0_GYF7zkFKWGPz9w1t-f',
	        	'Content-Type' => 'application/json'

	        ];


	       // $extra = array_merge($extra, ['notify_title' => $title, 'notify_text' => $text]);

	        $fields = [
	            //'to' => 'eWxP75RXN0I:APA91bGGgkLNA24b2-UvCUSN-YUBZfF04cBQ775cQtCQijRTG6kkg8XUbtHMRJs0BiIZKAV4alUu8jDvPsZ6_Y-e7RU1RrHO2bX8k0v08NkWghd1jaEqv89fa1hUtiq6NYqGcd2VaBzk',
              'to' => '/topics/general',
	            'notification' => $notification
	        ];

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
        //dd($valid);
				if($valid['message_id']==0){
					return false;
				}else{
					return true;
				}
        	}
        	else{
        		return false;
        	}

        }
        else{

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
