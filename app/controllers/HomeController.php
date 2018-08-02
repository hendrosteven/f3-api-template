<?php

class HomeController extends SecureRoute{

    function index(){
       $this->data = array(
           "success" => true,
           "payload" => ['messages'=>'Welcome', 'account'=>$this->account]
       );
    }
}
