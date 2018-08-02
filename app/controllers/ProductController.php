<?php

class ProductController extends SecureRoute{

    private $productSvr;

    function __construct(){
        parent::__construct();
        $this->productSvr = new ProductService();
    }

    function insert(){
        $code = $this->post['code'];
        $name = $this->post['name'];
        $description = $this->post['description'];
        $price = $this->post['price'];

        $v = new Valitron\Validator(array('Code'=>$code,'Name'=> $name, 'Price'=> $price));
        $v->rule('required', ['Code','Name','Price']);   

        if ($v->validate()) {
            $this->data = [
                'success'=> true, 
                'payload'=> $this->productSvr->save($code, $name, $description, $price)
            ];
        }else{
            $this->data = [
                'success'=> false, 
                'payload'=> $v->errors()
            ];
        }
    }
}