<?php
use \Firebase\JWT\JWT;

class SecureRoute extends BaseRoute{
    /** 
    * Get hearder Authorization
    * */
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
    * get access token from header
    * */
    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            $headersData = explode(" ", $headers);
            return $headersData[1];
        }else{
            return null;
        }
    }

    function validateToken($token) {
        try {
            $decoded = JWT::decode($token, $this->f3->get('key'), array('HS256'));
            $this->account = $decoded;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    function beforeroute(){
        $token = $this->getBearerToken();
        if(isset($token)){
		    if (!$this->validateToken($token)) {
                $this->errorData['code'] = 401;
                $this->errorData['message'] = 'Invalid Token';
                API::error($this->errorData['code'], $this->errorData['message']);
            }
        }else{
            $this->errorData['code'] = 401;
            $this->errorData['message'] = 'Please provide a token to access this resource';
            API::error($this->errorData['code'], $this->errorData['message']);
        }
    }
    
}