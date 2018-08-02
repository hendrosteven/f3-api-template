<?php

class BaseRoute {

    protected $f3;
    protected $data;
    protected $errorData = array();
    protected $logger;
    protected $account;  //current login account data
    protected $post; //request data

    function __construct() {
        $f3 = Base::instance();  
        $this->f3 = $f3;     
        $this->logger = new Log("app.log");   
        $this->post = json_decode($this->f3->get('BODY'),true);   
    }

    public function beforeroute(){
       
    }

    public function afterroute(){
		if(isset($this->errorData['code'])){
			API::error($this->errorData['code'], $this->errorData['message']);
		}else {            
            API::success($this->data);        
		}
	}

}
