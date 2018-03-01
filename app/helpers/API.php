<?php

class API{

    /**
	* Render a success encoding in JSON
	* @param array/object $data datas to send
	*/
	static function success($data)
	{	
		// Render all in json
		echo json_encode($data, JSON_NUMERIC_CHECK);
		die();
	}


	/**
	* Render an error in JSON
	* @param string $message error message
	* @param integer error code (404,500 etc...)
	*/
	static function error($code, $message)
	{	
		// Get the message to send
		$m = is_array($message) ? $message['status'] : $message;

		// Set the message and the code
		$data['message'] = $m;
		$data['code'] = $code;

		// Render all in json
		echo json_encode($data, JSON_NUMERIC_CHECK);
		die();
	}

}