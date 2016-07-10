<?php

class Plugin_User
{
    private $role;
    private $auth;
    private $data = [];
    
    
    public function __construct($role){
        $this->role = $role;
        $this->auth = Zend_Auth::getInstance();
        
        if ($this->role !== Plugin_ACL::GUEST) {
            $this->data['name'] = $this->auth->name;
        }
    }
    
    public function getData () {
        return $this->getData();
    }
}

