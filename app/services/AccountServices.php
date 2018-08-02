<?php
use \RedBeanPHP\R as R;

 class AccountServices extends BaseServiceReadBean{
    
    function save($email, $password){
        $acc = R::dispense( 'accounts' );
        $acc->email = $email;
        $acc->password = PasswordHash::hashing($password);
        $acc->create_date = date('Y-m-d H:i:s');
        $acc->update_date = date('Y-m-d H:i:s');
        $id = R::store( $acc );
        $newAcc = R::load( 'accounts', $id );
        return $newAcc;
    }

    function find($email, $password){
        return R::findOne( 'accounts', ' email = ?', 
            [ $email ] );
    }
}