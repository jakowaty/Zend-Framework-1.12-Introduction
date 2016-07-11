<?php

class Plugin_User
{
    private static $role = false;
    private static $data = false;
    
    
    public function __construct($role, stdClass $user){
        if (!self::$role AND !self::$data) {
            self::$role = $role;
            self::$data = $user; 
        }
    }
    
    public static function getData(){
        return clone self::$data;
    }
    
    public static function getRole(){
        return self::$role;
    }

    public static function getName(){
        if (isset(self::$data->name)) {
            return self::$data->name;
        } else {
            return false;
        }
    }
    
    
    public static function isAdmin(){
        return self::$role === Plugin_ACL::ADMIN;
    }
    
    public static function isUser(){
        if (self::isAdmin()) {
            return true;
        } else {
            return self::$role === Plugin_ACL::USER;
        }
    }
    
    public static function isLoggedIn(){
        return self::isUser();
    }
}

