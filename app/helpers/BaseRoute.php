<?php

class BaseRoute {

    protected $f3;
    //protected $db;
    protected $data;
    protected $errorData = array();
    protected $logger;
    protected $account;  //current login user

    function __construct() {
        $f3 = Base::instance();  
        $this->f3 = $f3;     
        $this->logger = new Log("app.log");
        //$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));  
        //$this->db = $db;          
    }

    public function afterroute(){
		if(isset($this->errorData['code'])){
			API::error($this->errorData['code'], $this->errorData['message']);
		}else {            
            API::success($this->data);        
		}
	}

}
