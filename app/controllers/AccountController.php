<?php
use \Firebase\JWT\JWT;

class AccountController  extends BaseRoute {

    private $accSvr;

    function __construct(){
        parent::__construct();
        $this->accSvr = new AccountServices();
    }

    function register(){
        $email = $this->post['email'];
        $password = $this->post['password'];
        $retype_password = $this->post['retype_password'];

        $v = new Valitron\Validator(array('Email'=>$email,'Password'=> $password, 'Retype Password'=> $retype_password));
        $v->rule('required', ['Email','Password','Retype Password']);   
        $v->rule('equals', 'Password', 'Retype Password');
        $v->rule('email', 'Email');

        if ($v->validate()) {
            $this->data = [
                'success'=> true, 
                'payload'=> $this->accSvr->save($email, $password)
            ];
        }else{
            $this->data = [
                'success'=> false, 
                'payload'=> $v->errors()
            ];
        }
    }

    function login(){
        $email = $this->post['email'];
        $password = $this->post['password'];

        $acc = $this->accSvr->find($email, $password);
        
        if ($acc!=null) {
            if(PasswordHash::verifying($password, $acc->password)){
                $payload = array(
                    "id" => $acc->id,
                    "email" => $acc->email,
                    "exp" => time() + (60*60) //1 jam 
                );
                $token =  JWT::encode($payload, $this->f3->get('key'));
                $this->data = ['success' => true, 'payload' => ['messages'=>'Token generated successfully', 'token' => ''. $token]];
            }else{
                $this->data = ['success' => false, 'payload' => 'Invalid username and/or password'];
            }
        } else {
            $this->data = ['success' => false, 'payload' => 'Invalid username and/or password'];
        }
    }

   
}