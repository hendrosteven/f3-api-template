<?php
use \RedBeanPHP\R as R;

class BaseServiceReadBean {

    function __construct(){
        $f3 = Base::instance(); 
        R::setup( $f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
        R::freeze( $f3->get('db_freeze') );
    }

}