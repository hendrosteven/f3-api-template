<?php

class HomeController extends SecureRoute{

    function index(){
       $this->data = $this->account;
    }
}