<?php namespace h;

define( 'ENDPOINT', 'https://fcm.googleapis.com/fcm/send');

define( 'SERVER_KEY', 'AAAAL7U2IbA:APA91bFpzG-j9Ast6QyVECQFmkZQKX_MOoM0ENNOCV4n4rPVwSK841NhMJM7BaGS0vFAE00EiuAckwK_olSorcsTCoxUkZJ6HLKr1buUzP7xGvLHRFQLTzhuhde2huvna4Ub1zugrv3PhfP4RFDa_Qm-oBM8PC6MGA' );

define( 'REGISTRATION_ID', 'dsgxtUDDBlI:APA91bHhrUQ6X9fLXr1TF7lz1lWm3H4zJWw-_etXeOjF2nUlSnkZoF1uupTQmlApdeZ9_NN64RN98zI2w2RPvU9_riekvxbQsdQbaWcJd569gnz7TcXs9-gwvakmg7RGZLZ5q6jSrqtOPNq9rUWQHrdqlx2guNcjXQ' );

/*
  Trigger Web Push notification

  @param $regIds (string) - Registration ID when client allowed notification
*/
class Web_Push {
  function __construct() {
  }

  function send_test() {
    $this->send( 'Web Push Test', 'It works!' );
  }


  function send( $title, $body ) {
    $msg = array(
  		'body' 	=> $body,
  		'title'	=> $title,
     	'icon'	=> 'myicon', /* Default Icon */
    	'sound' => 'mySound' /* Default sound */
    );

    $fields = array(
			'to' => REGISTRATION_ID,
			'notification' => $msg
		);

	  $headers = array(
  	  'Authorization: key=' . SERVER_KEY,
  		'Content-Type: application/json'
  	);

    #Send Reponse To FireBase Server
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, ENDPOINT );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

    #Echo Result Of FireBase Server
    var_dump( $result );
  }
}
