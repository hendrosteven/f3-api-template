<?php
use \Firebase\JWT\JWT;

class AccountController  extends BaseRoute {

    function login(){
        $post = json_decode($this->f3->get('BODY'),true);
        $email = $post['email'];
        $password = $post['password'];

        if ($email == 'hendro.steven@gmail.com' && $password == 'secret') {
            $payload = array(
                "id" => 761,
                "email" => "hendro.steven@gmail.com",
                "exp" => time() + (60*60) //1 jam 
            );
            $token =  JWT::encode($payload, $this->f3->get('key'));
            $this->data = ['result' => 1, 'message' => 'Token generated successfully', 'token' => ''. $token];
        } else {
            $this->data = ['result' => 0, 'message' => 'Invalid username and/or password'];
        }
    }

   
}